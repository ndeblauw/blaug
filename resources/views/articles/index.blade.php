
<h1>Overview of the articles</h1>

@foreach($articles as $article)
    <div>
        <h2>{{$article->title}}</h2>
        <p>Written by {{$article->author}}</p>
        <p>{{$article->content}}</p>
        <a href="/articles/{{$article->id}}">Read full article</a>
    </div>
@endforeach
