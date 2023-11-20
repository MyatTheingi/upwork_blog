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
            <h5 class="card-title">{{$article->title}}</h5>
            <div class="card-subtitle mb-2 text-muted small">
              
               Category :
                <span class="text-success">{{$article->category->name ?? 'Unknow' }}</span>
                Comments:
                {{ count($article->comments)}}
                
            </div>
            <p class="card-text">{{$article->body}}</p>

            <div class="small mt-2 float-end">
                <span class="text-success">{{ $article->user->name}}
                </span>,
                {{ $article->created_at->diffForHumans() }}
            </div>

            <a href="{{ url("/articles/detail/$article->id")}}" class="cardlink">View Detail &raquo;</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
