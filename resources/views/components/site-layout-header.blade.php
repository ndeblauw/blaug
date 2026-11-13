<div style="background-color: lightblue;">
    Logo

    @foreach($menu as $label => $link)
        <a href="{{$link}}">{{$label}}</a>
    @endforeach

    <hr/>
</div>
