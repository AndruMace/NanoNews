<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Feed::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('feeds.index', ['feeds'=>$feeds]);
    }

    public function store()
    {
        request()->validate([
           'term' => ['required', 'max:100']
        ]);

        if(Feed::where('user_id', Auth::user()->id)->where('term', request('term'))->count() >= 1)
        {
            Session::flash('message', "Can't enter duplicate Feeds");

            return redirect('/feeds');
        } else {
            $feed = new Feed();
            $feed->term = request('term');
            $feed->user_id = Auth::user()->id;
            $feed->save();

            return redirect("/feeds");
        }
    }

    public function delete($term)
    {
//        $feeds = Feed::where('term', $term)->where('user_id', Auth::user()->id);
        $feeds = Feed::where('user_id', Auth::user()->id)->where('term', $term);
        $feeds->delete();
        return redirect("/feeds");

    }
}
