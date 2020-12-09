<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield("title")</title>
</head>
<body>
    <header>
        @auth
            <a href="{{ url('/') }}">Home</a>
            <a href="{{url("/logout")}}"
               onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit()
            ">Logout</a>
            <form id="logout-form" action="{{url("/logout")}}" method="POST" style="display: none">
                {{csrf_field()}}
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endif
    </header>

    @yield("content")
</body>
</html>
