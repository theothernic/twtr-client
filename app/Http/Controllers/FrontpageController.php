<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class FrontpageController extends Controller
    {
        public function __invoke(Request $request)
        {
            return app()->make(TweetController::class)->index($request);
        }
    }
