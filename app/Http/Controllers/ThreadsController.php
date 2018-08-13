<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ThreadFilters $filters
     * @param Channel|null $channel
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ThreadFilters $filters, Channel $channel = null)
    {
        $threads = Thread::filters($filters, ['channel' => $channel])->latest()->get();

        if ($request->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);

        $thread = $request->user()
            ->threads()
            ->create($request->only(['title', 'body', 'channel_id']));

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @param  \App\Models\Thread $threadId
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, ThreadFilters $filters, $threadId)
    {
        /** @var Thread $thread */
        $thread = Thread::filters($filters, ['channel' => $channel])->findOrFail($threadId);
        $replies = $thread->replies()->paginate(2);

        return view('threads.show', compact('thread', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
