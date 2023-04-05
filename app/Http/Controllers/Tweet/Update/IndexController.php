<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Services\TweetService;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        $tweetId = (int) $request->route('tweetId');
        if(!$tweetService->checkOwnTweet($request->user()->id,$tweetId)){
            throw new AccessDeniedHttpException();
        }
        $tweet = Tweet::where('id',$tweetId)->firstOrFail();
        // dd($tweet);
        return view('tweet.update')->with('tweet', $tweet);

    }
}

/////////////////////////////////////////

class ClassA{
    private $classB;

    public function __construct(classB $classB){
        $this->classB = $classB;
    }
    public function run(){
        $this->classB->run();
    }
}

class ClassB{
    public function __construct(){

    }
    public function run(){
        //何かしらの処理
    }
}

$classB = new ClassB();
$classA = new ClassA($classB);