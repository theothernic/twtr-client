<?php
    namespace App\Http\Controllers;


    use App\Services\TweetService;
    use App\ViewModels\PageViewModel;

    use Illuminate\Http\Request;

    class TweetController
    {
        private TweetService $tweetService;

        public function __construct(TweetService $t)
        {
            $this->tweetService = $t;
        }

        public function index(Request $request)
        {
            $currPageNum = (int) $request->get('page') ?? 1;
            $page = new PageViewModel();
            $page->title = 'Tweet Index';
            $page->meta['description'] = 'A listing of tweets.';

            $t = $this->tweetService->paginated($request->get('page') ?? 1);

            $page->data = $t['data'];
            $page->total = $t['total'];

            $page->setPageNumber($request->get('page') ?? 1);




            return view('tweets.list', compact('page'));
        }


        public function show(string $id = '')
        {
            $page = new PageViewModel();
            $page->data = $this->tweetService->get($id)['data'];


            return view('tweets.show', compact('page'));

        }
    }
