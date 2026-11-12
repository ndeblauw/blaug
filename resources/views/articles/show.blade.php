<div>
    Logo  +
    <a href="{{route('articles.index')}}">Articles</a> +
    Contact +
    Login +
    <hr/>
</div>


<h1>{{$article->title}}</h1>

<div>
    <p>Written by {{$article->author}}</p>
    <p>{{$article->content}}</p>
</div>

<b>Comments section:</b><br/>
@foreach($article->comments as $comment)
    <div>
        {{$comment->created_at}}<br/>
        {{$comment->content}}<br/>
    </div>
@endforeach

<div>
    <a href="{{route('articles.index')}}">Back to articles overview</a>
</div>

<div>
    <hr/>
    This is my footer
</div>
