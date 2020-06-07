<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Feed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feeds = Feed::where('user_id', Auth::user()->id)->get();

        $responses = [];
        foreach ($feeds as $feed)
        {
            if (is_null($feed->last_searched_at) || Carbon::now()->diffInHours($feed->last_searched_at) > 12)
            {
                $feed->data = $feed->ExecuteSearch();
            }
            $res = json_decode($feed->data);
            $responses[$feed->term] = $res;
            $feed->last_searched_at = Carbon::now();
            $feed->save();
        }
//        dd($responses);
        return view('home', ['responses'=>$responses]);
    }

    public function feedback()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'comment' => ['required', 'max:1000']
        ]);

        $comment = new Comment();
        $comment->email = request('email');
        $comment->comment = request('comment');
        $comment->save();
        return redirect("/");
    }
}
