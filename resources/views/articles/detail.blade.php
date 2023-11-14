@extends("layouts.app")
@section("content")
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
            <h5 class="card-title">{{ $article->title}}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                <b>Category:</b> 
                <span class="text-success">{{ $article->category->name}}</span>
                {{$article->created_at->diffForHumans()}} 
            </div>
            <p class="card-text">{{ $article->body}}</p>
            @auth
                @can('delete-article', $article)
                    <a href="{{ url("/articles/delete/$article->id")}}" class="btn btn-warning">Delete</a>  
                @endcan
            @endauth
        </div>
    </div>

    <u class="list-group">
        <li class="list-group-item active">
            <b>Comments {{ count($article->comments)}}</b>
        </li>
         @foreach($article->comments as $comment)
        <li class="list-group-item">
            @can('delete-comment',$comment)
                <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
            @endcan
            {{$comment->content}}
        </li>
        @endforeach
    </u>
    @auth
    <form action="{{url('/comments/add')}}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{$article->id}}"/>
        <textarea name="content" class="form-control mb-2" placeholder="New Comment" ></textarea>
        <input type="submit" value="Add Comment" class="btn btn-secondary">
    </form>
    @endauth
</div>
@endsection
