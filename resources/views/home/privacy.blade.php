@extends('layouts.app', ['title' => 'Learn about StreamBuddy',
'description' => 'Learn about StreamBuddy. Why was it created and what it the purpose of the project.'])

@section('content')
    <div class="columns is-mobile is-multiline is-centered streams">

        <div class="column is-11-tablet is-8-desktop is-11-mobile about__box">
            <div class="columns is-multiline">
                <div class="column is-12 is-relative">
                    <h1 class="about__header">Privacy Policy</h1>
                </div>
                <div class="column is-12 is-relative">
                    <p style="  text-align: justify;">
                        Your privacy is important to us.
                        <br/>
                        We do not collect any personal data.
                        <br/>
                        Our website may link to external sites that are not operated by us. Please be aware that we have
                        no control over the content and practices of these sites, and cannot accept responsibility or
                        liability for their respective privacy policies.
                        <br/>
                        Your continued use of our website will be regarded as acceptance of our practices around privacy
                        and personal information.
                        <br/><br/>
                        This policy is effective as of 12 November 2019.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection