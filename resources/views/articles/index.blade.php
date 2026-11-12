
<h1>Overview of the articles</h1>

@foreach($articles as $article)
    <div>
        <h2>{{$article->title}}</h2>
        <p>Written by {{$article->author}}</p>
        <p>{{$article->content}}</p>
    </div>
@endforeach
