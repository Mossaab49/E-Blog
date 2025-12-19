@extends('layouts.app')

@section('content')





<div class=" container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold text-gray-800">Edit Posts</h1>
</div>

<div class=" container m-auto  pt-15 pb-5">
    <form action="/blog/{{$post->slug}}" method="POST" enctype="multipart/form-data" >@csrf @method('PUT')

    <input type="text" name="title" placeholder="Tilte" class="w-full h-20 text-4xl rounded-lg shadow-lg border-b p-12 mb-5" value="{{$post->title}}">


    <textarea name="description" placeholder="description" class="w-full h-60 text-l rounded-lg shadow-lg border-b p-15 mb-5" >{{$post->description}}</textarea>


    <div class="py-15">
        <label class="bg-blue-200 hover:bg-blue-500 text-gray-700 hover:text-gray-100 border border-gray-700 hover:border-transparent transition duration-300 cursor-pointer p-5 rounded-lg font-bold uppercase">
            <span>Select an image to upload</span>
            <input type="file" name="image"  class="hidden">
        </label>
    </div>

    
    <button type="submit" class="bg-green-500 hover:bg-green-600 text-gray-100 hover:text-gray-100 transition duration-300 cursor-pointer p-5 rounded-lg font-bold uppercase">Submit the post</button>
    </form>
</div>




@endsection