<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;


use Illuminate\Support\Facades\DB;


use Illuminate\Support\Str;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('blog.index', compact('posts'));
    }

    
    public function create()
    {
        return view('blog.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug. '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        // dd($newImageName);

        Post::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=> $slug,
            'image_path' => $newImageName,
            'user_id'=>auth()->user()->id
        ]);

        return redirect('/blog');
    }

    
    public function show($slug)
    {
        return view('blog.show')
        ->with('post', Post::where('slug', $slug)->first())
        ;
    }

   
    public function edit($slug)
    {
        return view('blog.edit')
        ->with('post', Post::where('slug', $slug)->first())
        ;
    }

    
    public function update(Request $request, $slug)
    {

        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'mimes:jpg,png,jpeg|max:5048'
        ]);

        if($request->image){
            $newImageName = uniqid() . '-' . $slug. '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            Post::where('slug', $slug)->update(['image_path' => $newImageName]);
        }
        

        Post::where('slug', $slug)
        ->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=> $slug
        ]);


        return redirect('/blog/' . $slug)
        ->with('message', 'Success alert! The post is modified succesfuly.');
    }

   
    public function destroy($slug)
    {
        Post::where('slug', $slug)->delete();
        
        return redirect('/blog')
        ->with('message', 'This post has been deleted.');
    }

    public function ban($user_id){
        User::where('id', $user_id)->update([
            'ban'=> DB::raw('NOT ban')
        ]);

        return redirect()->back()->with('message', 'Ban/Unban user toggled successfully !');
    }
}
