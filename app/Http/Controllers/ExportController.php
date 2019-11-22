<?php

namespace App\Http\Controllers;

use File;
use Imagick;
use App\User;
use ZipArchive;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use App\DataTables\PostsDataTable;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTable2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyImage;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function __construct()
    {
        $currentGuard = $this->get_guard();
        switch ($currentGuard) {
            case 'admin':
                $this->middleware('auth:admin')->except('logout');
                break;
            case 'user':
                $this->middleware('auth')->except('logout');
                break;
            default:
                $this->middleware('auth')->except('logout');
        }
    }

    public function exportUser(UsersDataTable $dataTable)
    {
        return $dataTable->render('export.user');
    }

    public function exportUser2(UsersDataTable2 $dataTable)
    {
        return $dataTable->render('export.user2');
    }

    public function exportPost(PostsDataTable $dataTable)
    {
        return $dataTable->render('export.post');
    }

    public function saveImage(UsersDataTable2 $dataTable)
    {
        $html = $dataTable->printPreview();
        return SnappyImage::loadHTML($html)->download('myfile.jpg');
    }
    public function savePdfView(Request $request)
    {
        $user = User::find($request->id);
        $view = View::make('export.usershow',compact('user'));
        $html = $view->render();
        $pdf = SnappyPdf::loadHtml($html)->download();
        return $pdf;
    }
    public function saveImageView(Request $request)
    {
        $user = User::find($request->id);
        $view = View::make('export.usershowimage',compact('user'));
        $html = $view->render();
        $image = SnappyImage::loadHtml($html);
        // dd($image);
        return $image->download('invoice.jpg');
    }
    public function savePdfToZipImage(UsersDataTable $dataTable)
    {
        //generate pdf
        $content = $dataTable->snappyPdf()->getOriginalContent();
        $foldername = $filename = date("Y-m-d");
        //save pdf 
        Storage::put("public/pdf/$foldername/$filename.pdf", $content);
        //create image path
        $imagePath = public_path("storage/image/$foldername");
        if (!File::isDirectory($imagePath)) {
            File::makeDirectory($imagePath, 0777, true, true);
        }
        //generate pdf to jpg
        $imageName = "$imagePath/image.jpg";
        // create Imagick object
        $imagick = new Imagick();
        $imagick->setResolution(200, 200);
        $imagick->readImage(public_path("storage/pdf/$foldername/$filename.pdf"));
        $imagick->writeImages($imageName, true);
        //generate jpg folder to zip
        $rootPath = $imagePath;
        $savePath = $imagePath;
        // $temp_zip = tempnam("/tmp", "");
        $temp_zip = tempnam(sys_get_temp_dir(), "");
        $zip = new ZipArchive();
        $zip->open($temp_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Initialize empty "delete list"
        $filesToDelete = array();

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);

                if ($file->getFilename() != 'important.txt') {
                    $filesToDelete[] = $filePath;
                }
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        // Delete all files from "delete list"
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
        // unlink(public_path("/storage/image/$filename/file.zip"));
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=data.zip');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_zip));
        ob_clean();
        flush();
        readfile($temp_zip);
        unlink($temp_zip); 
        
        // return Response::download("$imagePath/file.zip");
    }

    public function get_guard()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        } elseif (Auth::guard('web')->check()) {
            return "user";
        }
    }
}
