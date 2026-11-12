<div>
    Logo  +
    <a href="{{route('articles.index')}}">Articles</a> +
    Contact +
    Login +
    <hr/>
</div>

<h1>Overview of the articles</h1>

@foreach($articles as $article)
    <div>
        <h2>{{$article->title}}</h2>
        <p>Written by {{$article->author}}</p>
        <p>{{$article->content}}</p>
        <a href="{{ route('articles.show', $article) }}">Read full article</a>
    </div>
@endforeach

<div>
    <hr/>
    This is my footer
</div>
