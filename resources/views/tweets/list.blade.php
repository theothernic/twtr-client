@extends('themes.default')

@section('content')
    <ul class="tweets">
        @foreach($page->data as $record)
            <li>
                <article data-tweet-id="{{ $record->id }}">
                    {{ $record->body }}
                </article>

                <div class="meta flex align-items--center">
                    <div class="avatar">
                        &nbsp;
                    </div>
                    <div>
                        <div class="author">{{ $record->author }}</div>
                        <div>
                            <span class="dateline">{{ $record->created_at->format('m.d.Y g:i a') }}</span>
                            <span class="sep">&bull;</span>
                            <a href="{{ route('tweets.single', $record->id) }}" class="permalink">Permalink</a>

                            @unless($record->favorited == 0)
                            <span class="sep">&bull;</span>
                            <span class="favorited">
                                <i class="lni lni-heart-fill fill-red"></i> {{ $record->favorited }}
                            </span>
                            @endunless

                            @unless($record->retweeted == 0)
                            <span class="sep">&bull;</span>
                            <span class="retweeted">
                                <i class="lni lni-reload"></i> {{ $record->retweeted }}
                            </span>
                            @endunless
                        </div>

                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="pagination flex">

        @unless($page->currentPageNum == 1)
        <div class="prev flex-one align-self--start">
            <a href="{{ route('tweets.index', ['page' => $page->prevPageNum ]) }}"><i class="lni lni-arrow-left-circle big"></a></i>
        </div>
        @endunless

{{--        <div class="ordinals flex-one align-self--center">--}}
{{--            Page {{ $page->currentPageNum }} of {{ $page->totalPages }}--}}
{{--        </div>--}}

        @unless($page->nextPageNum == 0)
        <div class="next flex-one align-self--end">
            <a href="{{ route('tweets.index', ['page' => $page->nextPageNum ]) }}"><i class="lni lni-arrow-right-circle big"></a></i>
        </div>
        @endunless
    </div>
@endsection
