<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class SpatieLaravelHtmlController extends Controller
{
    public function createForm()
    {
        // $post = Post::find(1);
        // html()->model($post);
        // echo html()->date('start_date');
        // return $post->toArray();
        // return html()->model($post);

        // $post = new Post(['title' => 'simple title']);
        $post = Post::find(1);
        // html()->model($post);
        // echo html()->textarea('content');
        



        return view('spatielaravelhtml.editform', compact('post'));
    }
}
