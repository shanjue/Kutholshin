<?php

namespace App\Http\Controllers;

use App\Jobs\EncryptFile;
use App\Jobs\MoveFileToS3;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\Facades\FileVault;

class FileVaultController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $localFiles = Storage::files('files/' . auth()->user()->id);
        $s3Files = Storage::disk('s3')->files('files/' . auth()->user()->id);

        return view('filevault.filevault', compact('localFiles', 's3Files'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('userFile') && $request->file('userFile')->isValid()) {
            // files/1/ajksofnvznxcjvlsdosaidjf.jpeg
            $filename = Storage::putFile('files/' . auth()->user()->id, $request->file('userFile'));

            // check if we have a valid file uploaded
            if ($filename) {
                EncryptFile::withChain([
                    new MoveFileToS3($filename),
                ])->dispatch($filename);
            }
        }

        return redirect()->route('filevault')->with('message', 'Upload complete');
    }

    public function downloadFile($filename)
    {
        if (!Storage::disk('s3')->has('files/' . auth()->user()->id . '/' . $filename)) {
            abort(404);
        }
        // only work for s3 name only
        return response()->streamDownload(function () use ($filename) {
            FileVault::disk('s3')->streamDecrypt('files/' . auth()->user()->id . '/' . $filename);
        }, Str::replaceLast('.enc', '', $filename));
    }
}
