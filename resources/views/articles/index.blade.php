@extends("layouts.app")
@section("content")
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
            <small class="card-subtitle mb-2 text-muted">
                <b>Category :</b>
                <span class="text-success">{{$article->category->name}}</span>
                <b>Comments:</b>
                <span class="text-success">{{ count($article->comments)}}</span>
                {{ $article->created_at->diffForHumans() }}
            </small>
            <p class="card-text">{{$article->body}}</p>
            <a href="{{ url("/articles/detail/$article->id")}}" class="cardlink">View Detail &raquo;</a>
        </div>
    </div>
    @endforeach
</div>
@endsection