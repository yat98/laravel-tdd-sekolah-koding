<ul>
    @foreach($blogs as $blog)
        <li><a href="{{ route('blog.show',$blog) }}">{{ $blog->title }}</a></li>
    @endforeach
</ul>