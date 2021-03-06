@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <p>{{Auth::user()->name}}</p>
        <a href="/posts/create">create</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <small>{{ $post->user->name }}</small>
                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                </div>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline" onsubmit="return deletePost()">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button> 
                </form>
            @endforeach
        </div>
        <div class='pagenate'>
            {{ $posts->links() }}
        </div>
        <div>
            @foreach($questions as $question)
                <div>
                    <a href="https://teratail.com/questions/{{ $question['id'] }}">
                        {{ $question['title'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </body>
    <script>
        function deletePost() {
            if(window.confirm('削除すると復元できません．\n本当に削除しますか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</html>
@endsection