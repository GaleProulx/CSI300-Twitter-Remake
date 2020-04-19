@extends('layouts.app')

@section('content')

    <div class="tweet">
        <div class="filter-container">
            <a href="{{ route('timeline', 'all') }}" class="filter-button">All</a>
            <a href="{{ route('timeline', '1') }}" class="filter-button">Tweets</a>
            <a href="{{ route('timeline', '2') }}" class="filter-button">Favorites</a>
            <a href="{{ route('timeline', '3') }}" class="filter-button">Retweets</a>
        </div>
    </div>

    @foreach ($timeline as $post)
        <div class="tweet">
            <div class="header">
                <h1>{{ $post->handle }}</h1>
                <h1>{{ $post->at_type }}</h1>
            </div>
            <div class="sub-header">
                <h2>Author: <a href="{{ route('index_user', $post->author) }}">{{ $post->author }}</a></h2>
                <h2>{{ $post->action_date }}</h2>
            </div>
            <p class="content"> {{ $post->tweet_content }}</p>

            @if (Auth::check())
                <div class="options-wrapper">
                    <form method="POST" action="{{ route('favorite') }}"">
                        @csrf
                        <input id="tweet_id" type="hidden" name="tweet_id" value={{ $post->tweet_id }} required autofocus>
                        <button type="submit" class="timeline-option">
                            Favorite
                        </button>
                    </form>
                    <form method="POST" action="{{ route('retweet') }}">
                        @csrf
                        <input id="tweet_id" type="hidden" name="tweet_id" value={{ $post->tweet_id }} required autofocus>
                        <button type="submit" class="timeline-option">
                            Retweet
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
@endsection
