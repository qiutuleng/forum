<div class="panel panel-default">
    <div class="panel-heading">
        <a href="#">
            {{ $reply->getOwnerName() }}
        </a> said {{ $reply->created_at->diffForHumans() }}...
    </div>

    <div class="panel-body">
        {{ $reply->getBody() }}
    </div>
</div>
