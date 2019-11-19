<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PostsDataTable;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Auth;

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

    public function exportPost(PostsDataTable $dataTable)
    {
        return $dataTable->render('export.post');
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
