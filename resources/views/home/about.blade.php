@extends('layouts.app', ['title' => 'Learn about StreamBuddy',
'description' => 'Learn about StreamBuddy. Why was it created and what it the purpose of the project.'])

@section('content')
    <div class="columns is-mobile is-multiline is-centered streams">
        <div class="column is-11 has-text-centered">
            <h1 class="has-text-centered about__title">Learn about project</h1>
            <img src="{{asset('images/logo3.png')}}" alt="logo of the website">
        </div>
        <div class="column is-11-tablet is-8-desktop is-11-mobile about__box">
            <div class="columns is-multiline">
                <div class="column is-12 is-relative">
                    <p class="about__header">The story</p>
                </div>
                <div class="column is-12 is-relative">
                    <p style="  text-align: justify;">
                        StreamBuddy came to my mind in year 2018 when I was playing Fortnite regularly and saw how many
                        great
                        streamers were playing on Youtube platform instead of Twitch. Switching and checking
                        between two platforms was quite a hassle especially during big events. I never followed the
                        idea until October 2019 when I started working on StreamBuddy.<br/><br/>
                        My name is David and I used to play a lot of game, stream a lot of games and watch a lot of
                        streams. Never became a great streamer, but was playing high level Cs:Go, League of Legends and
                        Rocket League. After getting my degree in Computer Science and working on various projects
                        I decided it is time to do something on my own. StreamBuddy is the creation of my passion
                        to gaming and programming.<br/><br/>
                    </p>
                </div>
            </div>
        </div>
        <div class="column is-11-tablet is-8-desktop is-11-mobile about__box">
            <div class="columns is-multiline">
                <div class="column is-12 is-relative">
                    <p class="about__header">What is StreamBuddy?</p>
                </div>
                <div class="column is-12 is-relative">
                    <p style="text-align: justify;">
                        StreamBuddy is a cross-platform stream browser featuring top streams from platforms like Twitch
                        Mixer and Youtube. It is a web application designed for gaming live streams enthusiasts.
                        We put a lot of thoughts into what would gamers want to see and focused strongly on
                        user friendly design of the website. Nice design is not everything we wanted to do so
                        performance of the website is also designed to be as high as possible. Application is still in
                        development and will be updated accordingly to Your reviews and wishes. To help us take
                        StreamBuddy to another level join our <a target="_blank" href="https://discord.gg/sqxFVER">Discord!</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="column is-11-tablet is-8-desktop is-11-mobile about__box">
            <div class="columns is-multiline">
                <div class="column is-12 is-relative">
                    <p class="about__header">Our Vision</p>
                </div>
                <div class="column is-12 is-relative">
                    <p style="text-align: justify;">
                        Our ultimate goal is to make a perfect website for people who try to just watch a gaming
                        live stream but are not where to go. We want this website to perform as the go to place
                        for people to check what is being streamed on which website right now. We want people to come
                        here to read news from streaming world. And we want to make more features to make
                        StreamBuddy Your real buddy! If You want to with it join our <a target="_blank" href="https://discord.gg/sqxFVER">Discord</a>
                        and let us know Your thoughts!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection