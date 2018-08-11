<div class="panel panel-default">
    <div class="panel-heading">
        <a href="#">
            {{ $reply->getOwner()->getName() }}
        </a> said {{ $reply->created_at->diffForHumans() }}...
    </div>

    <div class="panel-body">
        {{ $reply->getBody() }}
    </div>
</div>
