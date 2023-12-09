@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $msg )
        {{ $msg }}
        @endforeach
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card mb-2">
        <div class="card-body">
            <span class="float-end small">
                {{ $article->created_at->diffForHumans() }}</span>
            <h5 class="card-title">{{ $article->title}}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                Author: <span class="text-success me-2">{{ $article->user->name}}</span>
                <span class="badge rounded-pill bg-success me-2">
                    {{$article->category->name}}
                </span>
            </div>
            <p class="card-text">{{ $article->body}}</p>

            <div class="clearfix mt-2">
                <div class="float-start">
                    <a href="#" class="btn  btn-outline" data-bs-toggle="tooltip" title="Vote">
                        <i class="fa-regular fa-hand"></i>30
                    </a>

                    <button class="btn btn-outline" type="button" data-bs-toggle="offcanvas" data-bs-target="#comments">
                        <i class="fa-regular fa-comment"></i>
                        {{count($article->comments)}}
                    </button>
                </div>

                <div class="float-end small">

                    <a href="#" class="btn  btn-outline" data-bs-toggle="tooltip" title="Bookmark">
                        <i class="fa-regular fa-bookmark"></i>
                    </a>


                    <i class="fa-solid fa-ellipsis " data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu dropdown-menu-end">

                        @auth
                        @can('delete-article', $article)
                        <li>
                            <a href="{{ url("/articles/edit/$article->id")}}" class="dropdown-item">Edit</a>
                        </li>
                        <li>
                            <a href="{{ url("/articles/delete/$article->id")}}" class="dropdown-item">Delete</a>
                        </li>
                        @endcan
                        @endauth
                        <!-- TODO  consider to develop !-->
                        <li class="dropdown-item"> Report</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <!-- TODO after comment, offcanvas disappear automatically. we need to refactor the comment updates without auto-closing the offcanvas  !-->

    <div class="offcanvas offcanvas-end" id="comments">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title">Comments ( {{ count($article->comments)}} )</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{url('/comments/add')}}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{$article->id}}" />
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <input type="reset" class="btn btn-sm btn-secondary" value="Cancel">

                <input type="submit" id="comment" class="btn btn-sm btn-primary" value="Comment">
            </form>

            <ul class="list-group list-group-flush mb-3">

                @foreach($article->comments as $comment)
                <li class="list-group-item">

                    @can('delete-comment',$comment)
                    <i class="fa-solid fa-ellipsis float-end" data-bs-toggle="dropdown"></i>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <!--TODO continue to develop the [edit] comment functionalities !-->
                        <li>
                            <a href="{{ url("/comments/edit/$comment->id") }}" class="dropdown-item">Edit</a>
                        </li>
                        <li>
                            <a href="{{ url("/comments/delete/$comment->id") }}" class="dropdown-item">Delete</a>
                        </li>
                        <li class="dropdown-item"> Report</li>
                    </ul>
                    @endcan

                    {{$comment->content}}
                    <div class="small mt-2">
                        By <span class="text-success">{{$comment->user->name}}
                        </span>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
                @endforeach
            </ul>
            @auth
        <form action="{{ url('/comments/add') }}" method="post">
         ...
        </form>
            @endauth
        </div>
    </div>
</div>
@endsection
