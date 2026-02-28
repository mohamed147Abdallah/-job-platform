<nav style="background: #f2f2f2; padding: 10px;">
    @auth
        @if(auth()->user()->role === 'founder')
            <a href="/">Home</a>
            <a href="/jobs/create">Post Job</a>
            <a href="/logout">Logout ({{ auth()->user()->name }})</a>
        @elseif(auth()->user()->role === 'freelancer')
            <a href="/">Home</a>
            <a href="/jobs">Browse Jobs</a>
            <a href="/logout">Logout ({{ auth()->user()->name }})</a>
        @endif
    @else
        <a href="/">Home</a>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endauth
</nav>
