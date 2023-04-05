<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        // $tweets = Tweet::all();
        // $tweets=Tweet::orderBy('created_at','DESC')->get();
        // dd($tweets);
        // return view('tweet.index', ['name' => 'laravel']);
        // $tweetService = new TweetService();
        $tweets = $tweetService->getTweets();
        // dump($tweets);
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dump report.'));
        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}

// use Illuminate\Support\Facades\View;
// class IndexController extends Controller{
//     public function __invoke(Request $request){
//         return View::make('tweet.index', ['name' => 'laravel']);
//     }

// }

// use Illuminate\View\Factory;

// class IndexController extends Controller{
//     public function __invoke(Request $request,Factory $factory){
//         return $factory->make('tweet.index', ['name' => 'laravel']);
//     }
// }