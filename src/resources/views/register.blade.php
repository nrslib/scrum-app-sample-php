@extends("layouts.no-header")
@section("title", "Register")
@section("content")
    <h1>Register</h1>
    <p>{{isset($message) ? $message : ""}}</p>
    <form action="/auth/register" method="post">
        {{csrf_field()}}
        <label>
            <input type="email" name="email" value="">
            Email
        </label>
        <label>
            <input type="text" name="name" value="">
            Name
        </label>
        <label>
            <input type="password" name="password">
            Password
        </label>
        <button type="submit">Submit</button>
    </form>
@endsection
