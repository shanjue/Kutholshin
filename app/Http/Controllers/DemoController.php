<?php

namespace App\Http\Controllers;

use App\DataTables\PostsDataTable;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DataTables\UsersDataTable;
use App\Post;
use Illuminate\Support\Facades\Validator;

class DemoController extends Controller
{
    public function kutholshin()
    {
        return view('demo.kutholshin');
    }

    public function asyncAwait()
    {
        return view('demo.asyncawait');
    }

    public function getUserAsyncAwait()
    {

        return [
            ['username' => 'mgmg'],
            ['username' => 'bobo']
        ];
    }

    public function laravelDatatable()
    {
        return view('demo.laraveldatatable');
    }

    public function dataLaravelDatatable()
    {
        return Datatables::of(User::all())->make(true);
    }

    public function laravelDatatable2()
    {
        return view('demo.laraveldatatable2');
    }

    public function dataLaravelDatatable2()
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
        // return Datatables::of($users)->make(true);
        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return
                    '<a href="' . route('user.show', $user->id) . '" class="btn btn-xs btn-primary" style="margin-right:20px;"><i class="fa fa-eye"></i> View</a>' .
                    '<a href="' . route('user.edit', $user->id) . '" class="btn btn-xs btn-warning" style="margin-right:20px;"><i class="fa fa-edit"></i> Edit</a>' .
                    '<a href="' . route('user.destroy', $user->id) . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function laravelDatatable3()
    {
        return view('demo.laraveldatatable3');
    }

    public function datalaravelDatatable3()
    {
        $users = User::select();

        return Datatables::of($users)
            ->addColumn('details_url', function ($user) {
                return url('user/posts/' . $user->id);
            })
            ->addColumn('postcount', function ($user) {
                return  count($user->posts);
            })
            ->addColumn('action', function ($user) {
                return
                    '<a href="' . route('user.show', $user->id) . '" class="btn btn-xs btn-primary" style="margin-right:20px;"><i class="fa fa-eye"></i> View</a>' .
                    '<a href="' . route('user.edit', $user->id) . '" class="btn btn-xs btn-warning" style="margin-right:20px;"><i class="fa fa-edit"></i> Edit</a>' .
                    '<a href="' . route('user.destroy', $user->id) . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->make(true);
    }

    public function userPosts($user_id)
    {
        $posts = User::find($user_id)->posts();

        return Datatables::of($posts)
            ->addColumn('action', function ($post) {
                return
                    '<a href="" class="btn btn-xs btn-primary" style="margin-right:20px;"><i class="fa fa-eye"></i> View</a>' .
                    '<a href="" class="btn btn-xs btn-warning" style="margin-right:20px;"><i class="fa fa-edit"></i> Edit</a>' .
                    '<a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->make(true);
    }

    public function datatable()
    {
        return view('demo.datatable');
    }

    public function postDatatable(Request $request)
    {
        if (!is_null($request->age)) {
            return response()->json(['success' => 'succeed']);
        } else {
            return response()->json(['success' => 'failed']);
        }
    }

    public function select2()
    {
        return view('demo.select2');
    }

    public function select2Post(Request $request)
    {
        return $request->all();
    }

    public function createPost()
    {
        $posts = Post::all();
        return view('demo.post.createpost', compact('posts'));
    }

    public function savePost()
    {
        Post::create(request()->all());

        return back();
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('demo.post.editpost', compact('post'));
    }

    public function updatePost($id)
    {
        $post = Post::find($id);
        $post->update(request()->all());

        return redirect(route('post.create'));
    }


    public function testComponent()
    {
        return view('demo.testcomponent');
    }

    public function testPostComponent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'imagehorizontal' => 'required',
            'title' => 'required|unique:posts|max:255|numeric',
            'titleforedit' => 'required|max:25|numeric',
            'content' => 'required|numeric',
            'contentedit' => 'required|numeric',
            'dob' => 'required|string',
            'dobtwo' => 'required|string',
            'description' => 'required|numeric',
            'descriptiontwo' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        return back()->withInput($request->input());
    }
}
