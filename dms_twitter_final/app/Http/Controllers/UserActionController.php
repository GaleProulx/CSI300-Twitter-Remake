<?php

namespace App\Http\Controllers;

use App\UserAction;
use App\Tweet;
use Illuminate\Http\Request;
use Auth;
use DB;

class UserActionController extends Controller
{
    /**
     * Require user authentication.
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($action_type)
    {
        if ($action_type >= 1 && $action_type <= 3) {
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
                ->where('UserAction.handle', '=', Auth::user()->name)
                ->where('UserAction.at_id', '=', $action_type)
                ->orderBy('UserAction.action_date', 'DESC')
                ->get();
        } else {
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
                ->where('UserAction.handle', '=', Auth::user()->name)
                ->orderBy('UserAction.action_date', 'DESC')
                ->get();
        }

        return view('tweets.timeline', [
          'timeline' => $timeline
        ]);
    }

    public function index_user($handle)
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
            ->where('UserAction.handle', '=', $handle)
            ->orderBy('UserAction.action_date', 'DESC')
            ->get();

        return view('welcome', [
          'timeline' => $timeline
        ]);
    }

    public function index_follow()
    {
        $follows = DB::table('Follower')
            ->select('handle_id', 'follow_id', 'follow_date')
            ->where('handle_id', '=', Auth::user()->name)->get();

        return view('follow', [
            'follows' => $follows
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        # Find next Tweet ID
        $tweet_id = DB::table('Tweet')->select('tweet_id')
            ->latest('tweet_id')->first()->tweet_id + 1;
        DB::insert('insert into Tweet values (?, ?)', [
            $tweet_id,
            $request->input('content')
        ]);

        DB::insert('insert into UserAction values (?, ?, ?, ?)', [
            Auth::user()->name,
            1,
            date('Y-m-d H:i:s'),
            $tweet_id
        ]);

        return redirect()->route('timeline', ['action_type' => 'all']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function favorite(Request $request)
    {
        $this->validate(request(), [
            'tweet_id' => 'required'
        ]);

        # Find next Tweet ID
        DB::insert('insert into UserAction values (?, ?, ?, ?)', [
            Auth::user()->name,
            2,
            date('Y-m-d H:i:s'),
            $request->input('tweet_id')
        ]);

        return redirect()->route('timeline', ['action_type' => 'all']);
    }

    public function retweet(Request $request)
    {
        $this->validate(request(), [
            'tweet_id' => 'required'
        ]);

        # Find next Tweet ID
        DB::insert('insert into UserAction values (?, ?, ?, ?)', [
            Auth::user()->name,
            3,
            date('Y-m-d H:i:s'),
            $request->input('tweet_id')
        ]);

        return redirect()->route('timeline', ['action_type' => 'all']);
    }

    public function follow(Request $request)
    {
        $this->validate(request(), [
            'handle' => 'required'
        ]);

        # Find next Tweet ID
        DB::insert('insert into Follower values (?, ?, ?)', [
            Auth::user()->name,
            $request->input('handle'),
            date('Y-m-d H:i:s')
        ]);

        return redirect()->route('follow');
    }
}
