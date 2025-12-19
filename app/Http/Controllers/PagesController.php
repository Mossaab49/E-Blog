<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {


        $post = Post::where('slug', 'how-to-create-a-blog')->first();

        
        if (!$post) {
            abort(404); 
        }

        
        return view('index', compact('post'));
    }
}
