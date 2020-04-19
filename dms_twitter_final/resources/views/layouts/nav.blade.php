<!-- ======================================== -->
<!-- Automatically included in app.blade.php. -->
<!-- ======================================== -->

<nav class="nav">
    <a href="/" class="website-title">Twitter Remake</a>
    @if (Auth::check())
        <a href="{{ route('tweet') }}">Tweet</a>
        <a href="{{ route('timeline', 'all') }}">Timeline</a>
        <a href="{{ route('follow') }}">Follows</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endif
</nav>
