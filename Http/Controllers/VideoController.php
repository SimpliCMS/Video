<?php

namespace Modules\Video\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Controllers\Controller;
use Modules\Video\Contracts\Video;
use Modules\Video\Models\VideoProxy;
use Modules\User\Models\User;
use Modules\Profile\Models\Profile;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $videos = VideoProxy::all();
        return view('video::index', compact('videos'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function profileIndex($username)
    {
        $user = User::where('username', $username)->first();
        $profile = Profile::where('user_id', $user->id)->first();
        $videos = VideoProxy::where('user_id', $user->id)->get();
        return view('video::profile.index', ['user' => $user, 'profile' => $profile, 'videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('video::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Video $video)
    {
        views($video)->record();
        $channelUser = User::where('id', $video->user_id)->first();
        return view('video::show', [
            'video' => $video,
            'channelUser' => $channelUser
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('video::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

}
