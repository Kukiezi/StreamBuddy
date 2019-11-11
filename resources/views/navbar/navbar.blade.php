<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">

        <a class="navbar-item navbar__logo" href="/"
           style='background: url("{{asset('images/logo3.png')}}") no-repeat center; background-size: contain;'>
        </a>

        {{--        <a class="navbar-item navbar__logo is-hidden-desktop is-hidden-tablet" href="/"--}}
        {{--           style='background: url("{{asset('images/sbicon.png')}}") no-repeat center; background-size: contain;'>--}}
        {{--        </a>--}}
        <span role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
              data-target="navMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </span>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <a href="/" class="navbar-item has-text-white">
                Browse Streams
            </a>
            <a href="/news" class="navbar-item has-text-white">
                Streaming News
            </a>

            <a class="navbar-item has-text-white">
                {{--                Documentation--}}
            </a>
        </div>

        <div class="navbar-end">
            <a class="navbar-item" style="padding-right: 2em;" target="_blank" href="https://discord.gg/sqxFVER">
                Join our discord server
                <span style="padding-left: 0.5em; color: #7289DA; font-weight: normal;"><i class="fab fa-discord fa-2x"></i></span>
            </a>
            {{--            @if (Auth::guest())--}}
            {{--                <a class="navbar-item" href="{{ url('/login/google') }}"><img class="navbar__login"--}}
            {{--                                                                              src={{asset('images/google_signin_buttons/web/1x/btn_google_signin_dark_normal_web.png')}}></a>--}}
            {{--            @else--}}
            {{--                {{ Auth::user()->name }} <span class="caret"></span>--}}

            {{--                <a class="dropdown-item" href="{{ route('logout') }}"--}}
            {{--                   onclick="event.preventDefault();--}}
            {{--                                                     document.getElementById('logout-form').submit();">--}}
            {{--                    {{ __('Logout') }}--}}
            {{--                </a>--}}

            {{--                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
            {{--                    @csrf--}}
            {{--                </form>--}}
            {{--            @endif--}}
        </div>
    </div>
</nav>

<script type="text/javascript">
    (function () {
        var burger = document.querySelector('.burger');
        var nav = document.querySelector('#' + burger.dataset.target);
        burger.addEventListener('click', function () {
            burger.classList.toggle('is-active');
            nav.classList.toggle('is-active');
        });
    })();
</script>