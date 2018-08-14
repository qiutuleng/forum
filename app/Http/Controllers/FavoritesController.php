<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, Reply $reply)
    {
        $reply->favorite();

        return $request->wantsJson() ? $this->noContent() : back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request, Reply $reply)
    {
        $reply->cancelFavorite();

        return $request->wantsJson() ? $this->noContent() : back();
    }
}
