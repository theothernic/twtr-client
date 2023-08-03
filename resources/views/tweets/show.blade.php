@extends('themes.default')

@section('content')
    <div>
        <article class="single" data-tweet-id="{{ $page->data->id }}">
            {{ $page->data->body }}
        </article>

        <div class="meta flex align-items--center">
            <div class="avatar">
                &nbsp;
            </div>
            <div>
                <div class="author">{{ $page->data->author }}</div>
                <div>
                    <span class="dateline">{{ $page->data->created_at->format('m.d.Y g:i a') }}</span>
                    <span class="sep">&bull;</span>
                    <a href="{{ route('tweets.single', $page->data->id) }}" class="permalink">Permalink</a>
                </div>

            </div>
        </div>
    </div>
@endsection
