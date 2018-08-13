@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->getOwnerName() }}</a> posted:
                        {{ $thread->getTitle() }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->getBody() }}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                <div class="without-pagination-margin-top">
                    {{ $replies->links() }}
                </div>

                @auth
                    <form method="post" action="{{ route('replies.store', $thread) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="Have something to say?"
                                      rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                @else
                    <p class="text-center">
                        Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
                    </p>
                @endauth
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }}</p>
                        by
                        <a href="#">{{ $thread->getOwnerName() }}</a>
                        , and currently has {{ $replies->count() }} {{ str_plural('comment',$replies->count()) }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
