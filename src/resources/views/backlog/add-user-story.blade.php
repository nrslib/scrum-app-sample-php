@extends("layouts.default")
@section("title", "BackLog AddUserStory")
@section("content")
<h1>Backlog</h1>
<h2>AddUserStory</h2>

<form action="/backlog/add-user-story" method="post">
    {{csrf_field()}}
    <button type="submit">Submit</button>
</form>

@endsection
