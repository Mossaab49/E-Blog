@extends('layouts.app')

@section('content')

@if(session()->has('message'))
<div class="container max-w-md mx-auto p-4 m-4 text-lg sm:text-xl text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400 text-center" role="alert">
  <span class="font-medium">{{ session()->get('message') }}.</span> 
</div>
@endif





<div class=" container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold text-gray-800">All Posts</h1>
</div>


<div class="container grid grid-cols-1 sm:grid-cols-2 gap-6 mx-auto p-5 border-b border-gray-300 flex items-center ">
    @if(Auth::check())
        <a href="/blog/create" 
            class="bg-green-500 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase border-2 border-transparent transition duration-200 hover:text-green-600 hover:bg-transparent hover:border-green-600 sm:w-auto mx-auto sm:mx-0 text-center" style="max-width:150px">
            Add Post
        </a>
    @endif

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" onkeyup="filterBlogs()" class="block w-full p-4 pl-10 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Subject ..." required />
    </div>
</div>



@foreach($posts as $post)


<div class="container sm:grid grid-cols-2 gap-15 mx-auto py-15 px-5 border-b border-gray-300 blog" data-title="{{$post->title}}" id="{{$post->id}}">
    <div class="flex ">
        <img class="object-cover" src="/images/{{$post->image_path}}" alt="">
    </div>

    <div>
        <h2 class="text-gray-700 font-bold text-4xl py-5 md:pt-0">
            {{$post->title}}
        </h2>
        <div>
            By: <span class="text-gray-500 italic">{{$post->user->name}}</span>
            on: <span class="text-gray-500 italic">{{date('d-m-Y',strtotime($post->created_at) )}}</span>
            
            <p class="py-3"><span class="text-gray-500 italic">modified on: {{date('d-m-Y',strtotime($post->updated_at) )}}</span></p>
            <p class="text-l text-gray-700 py-8 leading-6">
            {{$post->description}} ...
            </p>

            <a href="/blog/{{$post->slug}}" class="bg-blue-800 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase place-self-start border-2 border-solid border-transparent transition duration-200 hover:text-blue-800 hover:bg-transparent hover:border-blue-800">Read More</a>

        </div>
    </div>
</div>

@endforeach





@endsection

@section('script')

<script>
    function filterBlogs() {
    let input = document.getElementById('default-search').value.toLowerCase();
    let blogs = document.querySelectorAll('.blog'); // Select all member divs

    blogs.forEach(function(blog) {
        let name = blog.getAttribute('data-title').toLowerCase(); // Get the data-title attribute
        if (name.includes(input)) {
            blog.style.display = ''; // Show the blog
        } else {
            blog.style.display = 'none'; // Hide the others 
        }
    });
}

    
</script>

@endsection