@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>
    @endif

    {{ $articles->links()}}
    @foreach( $articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <span class="float-end small">
                {{ $article->created_at->diffForHumans() }}</span>
            <h5 class="card-title me-2">{{$article->title}}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                Author:
                {{ $article->user->name}}
                <span class="badge rounded-pill bg-success ms-2">
                    {{$article->category->name}}
                </span>
            </div>
            <p class="card-text">{{$article->body}} <a href="{{ url("/articles/detail/$article->id")}}"
                    class="cardlink">read more &raquo;</a></p>

            <div class="clearfix mt-2">
                <div class="float-start">
                    <!-- TODO continue to develop the vote functionalities !-->
                    <a href="#" class="btn  btn-outline" data-bs-toggle="tooltip" title="Vote">
                        <i class="fa-regular fa-hand"></i>30
                    </a>

                    <a href="{{ url("/articles/detail/$article->id")}}" class="btn btn-outline"
                        data-bs-toggle="tooltip" title="Comment">
                        <i class="fa-regular fa-comment"></i>
                        {{count($article->comments)}}
                    </a>
                </div>
                <div class="float-end small">
                    <!-- TODO continue to develop the bookmark functionalities !-->
                    <a href="#" class="btn  btn-outline" data-bs-toggle="tooltip" title="Bookmark">
                        <i class="fa-regular fa-bookmark"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
