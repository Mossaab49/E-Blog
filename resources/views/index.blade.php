@extends('layouts.app')

@section('content')

<!-- Hero -->

<div class="hero-bg-image flex flex-col items-center justify-center">
    <h1 class="text-gray-100 text-4xl text-center uppercase font-bold pb-10 sm:text-5xl">Welcome to E-Blogs</h1>
    <a href="/blog" class="bg-gray-100 text-gray-700 py-4 px-5 rounded-lg font-bold uppercase text-xl border-2 border-solid border-transparent transition duration-200 transform hover:scale-105">
    Start Reading
</a>

</div>


<!-- How to be an expert -->
<div class="bg-blue-100">

<div class="expert container sm:grid grid-cols-2 gap-15 mx-auto py-15">
    <div class="mx-2 md:mx-0">
        <img class="sm:rounded-lg" src="/images/{{$post->image_path}}" alt="">
    </div>

    <div class="flex flex-col items-left justify-center m-10 sm:m-0">
        <h2 class="font-bold text-gray-700 text-xl uppercase">{{$post->title}}</h2>

        <p class="font-bold text-gray-500 text-l pt-2">
            {{date('d-m-Y',strtotime($post->updated_at) )}}
        </p>

        <p class="py-4 text-gray-500 text-sm leading-5">
            {{$post->description}} ...
        </p>

        <a href="/blog/{{$post->slug}}" class="bg-gray-700 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase place-self-start transition duration-200 border-2 border-solid border-transparent transition duration-200 hover:text-gray-700 hover:bg-gray-100 hover:border-gray-700">Read More</a>

    </div>
</div>
</div>


<!-- Blog Categories -->

<div class="text-center p-15 bg-blue-500 text-gray-100">
    <h2 class="text-2xl">Blog Categories</h2>
    <div class="container mx-auto pt-10 sm:grid grid-cols-4">
        <span class="font-bold text-3xl py-2">Education</span>
        <span class="font-bold text-3xl py-2">Self improvement</span>
        <span class="font-bold text-3xl py-2">Stories</span>
        <span class="font-bold text-3xl py-2">& more</span>
    </div>
</div>


<!-- Important Subjects -->
<div class="bg-blue-100" id="IS">
<div class="container mx-auto text-center py-15">
    <h2 class="font-bold text-5xl py-10">Important Subjects</h2>
    <p class="text-gray-400 leading-6 px-10">
        Every great journey starts with a lesson. Explore powerful stories, self-improvement techniques, and advanced education insights to fuel your personal and intellectual growth. Let’s learn, evolve, and inspire together!
    </p>
</div>

<div class="sm:grid grid-cols-2 w-4/5 mx-auto">
    <div class="flex bg-blue-700 text-gray-100 pt-10">
        <div class="block m-auto pt-4 pb-15 w-4/5">


            <ul class="md:flex text-xs gap-2">
                <li class="bg-blue-100 text-gray-700 p-2 rounded inline-block my-1 md:my-0 border border-transparent hover:border-gray-100 hover:bg-blue-500 hover:text-gray-100 transition duration-300 cursor-pointer"><div class="sub" id="prog" >Programming</div></li>
                <li class="bg-blue-100 text-gray-700 p-2 rounded inline-block my-1 md:my-0 border border-transparent hover:border-gray-100 hover:bg-blue-500 hover:text-gray-100 transition duration-300 cursor-pointer"><div class="sub" id="cyber">CyberSecurity</div></li>
                <li class="bg-blue-100 text-gray-700 p-2 rounded inline-block my-1 md:my-0 border border-transparent hover:border-gray-100 hover:bg-blue-500 hover:text-gray-100 transition duration-300 cursor-pointer"><div class="sub" id="lang" >Languages</div></li>
                <li class="bg-blue-100 text-gray-700 p-2 rounded inline-block my-1 md:my-0 border border-transparent hover:border-gray-100 hover:bg-blue-500 hover:text-gray-100 transition duration-300 cursor-pointer"><div class="sub" id="self" >Self-improvement</div></li>
            </ul>


            <h3 class="text-l py-10 leading-6 transition duration-300 ease-in-out" id="parag">
            Programming is more than just writing code—it’s about solving real-world problems and bringing ideas to life. Every successful app, game, and website started as a simple idea. Whether you're just starting out or an experienced coder, there's always something new to learn and share. Write about your coding journey, challenges, and breakthroughs—your story could be the guide that helps others take their first steps into the world of programming!
            </h3>

            <a href="/blog" class="bg-transparent border-2 text-gray-100 py-4 px-5 rounded-lg font-bold uppercase text-l inline-block transition duration-200 hover:bg-gray-100 hover:text-blue-700">Read More</a>
        </div>
    </div>

    <div class="flex">
        <img class="object-cover transition duration-300 ease-in-out border-2 border-blue-700" id="img" src="/images/photo-prog.avif" alt="">
    </div>
</div>


<script>
    let parag = document.getElementById("parag");
    let sub = document.querySelectorAll(".sub");

    let descriptions = {
        "prog": "Programming is more than just writing code—it’s about solving real-world problems and bringing ideas to life. Every successful app, game, and website started as a simple idea. Whether you're just starting out or an experienced coder, there's always something new to learn and share. Write about your coding journey, challenges, and breakthroughs—your story could be the guide that helps others take their first steps into the world of programming!",
        "cyber": "The digital world is expanding, and so are the threats that come with it. Cybersecurity is not just a field—it’s a mission to protect data, privacy, and online freedom. By sharing your knowledge and experiences, you can help others understand the importance of online security. Whether it’s a beginner’s guide to staying safe online or an analysis of the latest threats, your blog could be the one that makes a difference in someone’s digital safety.",
        "lang": "Learning a new language is like unlocking a new world. It connects you to different cultures, people, and opportunities. The struggles, triumphs, and funny mistakes along the way make the journey unique. Why not write about it? Share your learning methods, experiences, and tips to help others on their language journey. Your words could inspire someone to take their first step toward fluency!",
        "self": "Every great achievement starts with a single step toward self-improvement. Whether it's building better habits, developing confidence, or learning from failure, the journey of personal growth shapes who we become. Your experiences, struggles, and lessons can inspire others to take charge of their lives. Why not share your journey? Your words might be the motivation someone else needs to start theirs."
    };

    let img = document.getElementById("img");

    


    sub.forEach(subject => {
        subject.addEventListener("click", function () {
            let subjectId = this.id; 
            parag.style.opacity = 0;
            img.style.opacity =0;


            setTimeout(() => {
            parag.innerHTML = descriptions[subjectId] || "No description available.";

            img.src = `/images/photo-${subjectId}.avif`;


            parag.style.opacity = 1;
            img.style.opacity=1;
        }, 300); 
        });
    });



    

    

</script>

@endsection