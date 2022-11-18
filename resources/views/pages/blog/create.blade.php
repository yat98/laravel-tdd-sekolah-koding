<h1>Create Blog</h1>
<form action="{{ route('blog.store') }}" method="POST">
    @csrf
    <p>
        <label for="title">Title</label>
        <input type="text" name="title">
    </p>
    <p>
        <label for="subject">Subject</label>
        <textarea name="subject" id="" cols="30" rows="10"></textarea>
    </p>
    <input type="submit" value="Post Blog">
</form>