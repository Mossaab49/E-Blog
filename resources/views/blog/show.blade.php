@extends('layouts.app')

@section('links')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

@section('content')

@if(session()->has('message'))
<div class="container max-w-md mx-auto p-4 m-4 text-xl text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400 text-center" role="alert">
  <span class="font-medium">{{ session()->get('message') }}.</span> 
</div>
@endif




<div class=" container m-auto text-center pt-15 pb-5">
    <h1 class="text-6xl font-bold text-gray-800 mb-6">{{$post->title}}</h1>
    <div class="mt-2">
        By: <span class="text-gray-500 italic">{{$post->user->name}}</span>
        on: <span class="text-gray-500 italic">{{date('d-m-Y',strtotime($post->created_at) )}}</span>
        <p class="text-gray-500 italic py-3">modified on: {{date('d-m-Y',strtotime($post->updated_at) )}}</p>
    </div>
</div>

<div class=" container m-auto px-3  pt-16 pb-5">

    <div class="flex h-96">
        <img src="/images/{{$post->image_path}}" class="object-cover w-full" alt="">
    </div>

    <div class="text-l text-gray-700 py-8 leading-6">
        {{$post->description}}
    </div>



    <div class="flex justify-between items-center">
    <!-- Left-aligned buttons (Edit, Delete, Ban) -->
    <div>
        @if(Auth::check())
            @if((Auth::user() && Auth::user()->id == $post->user_id) || Auth::user()->id == 2)
                <a href="/blog/{{$post->slug}}/edit" class="bg-green-400 text-gray-100 py-4 px-5 inline-block rounded-lg font-bold uppercase ml-5 border-2 border-solid border-transparent transition duration-200 hover:text-green-500 hover:bg-transparent hover:border-green-500">Edit Post</a>

                <form action="/blog/{{$post->slug}}" method="post" class="inline-block" id="delete-form">
                    @csrf
                    @method('delete')
                    <button type="button" onclick="confirmDelete()" class="bg-red-600 text-gray-100 py-4 px-5 inline-block rounded-lg font-bold uppercase ml-5 transition duration-200 hover:bg-red-700">Delete Post</button>
                </form>

                @if(Auth::user()->id == 2) <!-- Check if the authenticated user is an admin (ID = 2) -->
                    <form action="{{ route('blog.ban', $post->user_id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-orange-400 text-gray-100 py-4 px-5 inline-block rounded-lg font-bold uppercase ml-5 transition duration-200 hover:bg-orange-500">
                            @if($post->user->ban == 0) <!-- Check the post owner's ban status -->
                                Ban User
                            @elseif($post->user->ban == 1)
                                Unban User
                            @endif
                        </button>
                    </form>
                @endif
            @endif
        @endif
    </div>

    <!-- Right-aligned button (Back) -->
    <div>
        <a href="/blog#{{$post->id}}" class="bg-blue-600 text-gray-100 py-4 px-5 inline-block rounded-lg font-bold uppercase ml-5 border-2 border-solid border-transparent transition duration-200 hover:text-blue-600 hover:bg-transparent hover:border-blue-600">
            <i class="fa-solid fa-arrow-left"></i> <span>Back</span>
        </a>
    </div>
</div>
</div>




@endsection


@section('script')


<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            backdrop: 'rgba(0,0,0,0.5)',
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                popup: 'custom-popup-class',
                title: 'custom-title-class',
                confirmButton: 'custom-confirm-button-class',
                cancelButton: 'custom-cancel-button-class'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms
                document.getElementById('delete-form').submit();
            }
        });
    }


</script>


@endsection