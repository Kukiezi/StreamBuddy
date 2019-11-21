@extends('layouts.app', ['title' => 'Log in to Your StreamBuddy account',
'description' => 'Log in or register account on StreamBuddy using google, github or facebook'])

@section('content')
    <div class="container login" style="padding-top: 2rem;">
        <div class="columns is-mobile is-centered is-multiline">
            <div class="column is-8-desktop is-10-mobile">
                <h1 class="login__header">Login with Google, Github or Facebook</h1>
                <p class="login__text">Having account allows You to follow streams You enjoy and see them in left
                    sidebar when You open the
                    page. We are developing new features everyday! Account will allow You to make full use
                    of them.</p>
                <div class="columns is-multiline" style="padding-top: 1rem;">
                    <div class="column is-4">
                        <a href="{{ url('/login/google') }}" class="google btn"><i class="fa fa-google fa-fw">
                            </i> Login with Google+
                        </a>
                    </div>
                    <div class="column is-4">
                        <a href="{{ url('/login/facebook') }}" class="fb btn">
                            <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                        </a>
                    </div>
                    <div class="column is-4">
                        <a href="{{ url('/login/github') }}" class="github btn" style="text-decoration: none">
                            <i class="fa fa-github fa-fw"></i> Login with Github
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection