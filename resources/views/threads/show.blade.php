@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->getOwnerName() }}</a> posted:
                        {{ $thread->getTitle() }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->getBody() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->getReplies() as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @auth
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="post" action="{{ route('replies.store', $thread) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="Have something to say?"
                                      rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
            </p>
        @endauth
    </div>
@endsection
