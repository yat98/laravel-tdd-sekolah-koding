<h1>Edit Blog</h1>
<form action="{{ route('blog.update', $blog) }}" method="POST">
    @csrf
    @method('PUT')
    <p>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title') ?? $blog->title }}">
    </p>
    <p>
        <label for="subject">Subject</label>
        <textarea name="subject" id="" cols="30" rows="10">{{ old('subject') ?? $blog->subject }}</textarea>
    </p>
    <input type="submit" value="Update Blog">
</form>