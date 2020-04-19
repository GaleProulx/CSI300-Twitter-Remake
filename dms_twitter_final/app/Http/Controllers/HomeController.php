<?php

namespace App\Http\Controllers;

use App\UserAction;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $timeline = UserAction::select(
            'UserAction.handle', 'ActionType.at_type', 'Tweet.tweet_id',
            'Tweet.tweet_content', 'UserAction.action_date',
            'UserAction.action_date', 'author.handle as author'
        )
        ->join('Tweet', 'UserAction.tweet_id', '=', 'Tweet.tweet_id')
        ->join('ActionType', 'UserAction.at_id', '=', 'ActionType.at_id')
        ->join('UserAction as author', function($join) {
            $join
            ->on('UserAction.tweet_id', '=', 'author.tweet_id')
            ->where('author.at_id', '=', 1);
        })
        ->orderBy('UserAction.action_date', 'DESC')
        ->get();

        return view('welcome', [
          'timeline' => $timeline
        ]);
    }
}
