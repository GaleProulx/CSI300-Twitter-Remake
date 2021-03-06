@extends('layouts.app')

@section('content')
    @foreach ($timeline as $post)
        <div class="tweet">
            <div class="header">
                <h1><a href="/handle/{{ $post->handle }}">{{ $post->handle }}</a></h1>
                <h1>{{ $post->at_type }}</h1>
            </div>
            <div class="sub-header">
                <h2>Author: {{ $post->author }}</h2>
                <h2>{{ $post->action_date }}</h2>
            </div>
            <p class="content"> {{ $post->tweet_content }}</p>
            @if (Auth::check())
                <div class="options-wrapper">
                    <form method="POST" action="{{ route('favorite') }}"">
                        @csrf
                        <input id="tweet_id" type="hidden" name="tweet_id" value={{ $post->tweet_id }} required>
                        <button type="submit" class="timeline-option">
                            Favorite
                        </button>
                    </form>
                    <form method="POST" action="{{ route('retweet') }}">
                        @csrf
                        <input id="tweet_id" type="hidden" name="tweet_id" value={{ $post->tweet_id }} required>
                        <button type="submit" class="timeline-option">
                            Retweet
                        </button>
                    </form>
                    <form method="POST" action="{{ route('follow') }}"">
                        @csrf
                        <input id="handle" type="hidden" name="handle" value={{ $post->handle }} required>
                        <button type="submit" class="timeline-option">
                            Follow
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
@endsection
