<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <div class="flex">
                <a href="#">
                    {{ $reply->getOwnerName() }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </div>

            <div>
                <form method="post" action="{{ route('replies.favorites', $reply) }}">
                    {{ csrf_field() }}

                    @php
                        $favoritesCount = $reply->getFavoritesCount();
                    @endphp

                    <button type="submit" class="btn btn-default" @if($reply->isFavorited()) disabled @endif>
                        {{ $favoritesCount }} {{ str_plural('Favorite', $favoritesCount) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->getBody() }}
    </div>
</div>
