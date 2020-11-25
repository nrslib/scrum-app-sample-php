@extends("layouts.default")
@section("title", "Login")
@section("content")
    <h1>Login</h1>
    <form action="/auth/login" method="post">
        {{csrf_field()}}
        <input type="text" name="id" value="">
        <input type="password" name="password">
        <button type="submit">Submit</button>
    </form>
@endsection
