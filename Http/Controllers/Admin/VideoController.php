<?php

namespace Modules\Video\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Controllers\Controller;
use Modules\Video\Contracts\Requests\CreateVideo;
use Modules\Video\Contracts\Requests\UpdateVideo;
use Modules\Video\Contracts\Video;
use Alaouy\Youtube\Facades\Youtube;
use Modules\Video\Models\VideoProxy;
use Modules\Video\Models\VideoStateProxy;

class VideoController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $videos = VideoProxy::all();
        return view('video-admin::index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('video-admin::create', [
            'video' => app(Video::class),
            'states' => VideoStateProxy::choices()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateVideo $request) {
        try {
            $user = Auth::user();
            if ($request->has('url') && !empty($request->input('url'))) {
                $videoUrl = $request->input('url');

                // Extract the video ID from the URL
                $videoId = Youtube::parseVidFromURL($videoUrl);

                // Fetch video data
                $videoData = Youtube::getVideoInfo($videoId);
                $embedid = $videoData->id;

                // Extract the URL from the embed HTML
                // Access the desired properties from the video data
                $title = $videoData->snippet->title;
                $description = $videoData->snippet->description;
                $thumbnailUrl = $videoData->snippet->thumbnails->maxres->url;
                $duration = $videoData->contentDetails->duration;

                $video = VideoProxy::create([
                            'name' => $title,
                            'user_id' => $user->id,
                            'url' => $request->input('url'),
                            'service' => 'youtube',
                            'service_id' => $embedid,
                            'description' => $description,
                            'is_upload' => false,
                            'state' => $request->input('state')
                ]);
                $video->addMediaFromUrl($thumbnailUrl)
                        ->toMediaCollection('service_image');
            } else {
                $video = VideoProxy::create($request->except('video'));
            }

            flash()->success(__(':name has been created', ['name' => $video->name]));

            try {
                if (!empty($request->files->filter('images'))) {
                    $video->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection();
                    });
                }
            } catch (\Exception $e) { // Here we already have the service created
                flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

                return redirect()->route('video.admin.edit', ['video' => $video]);
            }
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }
        return redirect()->route('video.admin.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Video $video) {
        return view('video-admin::show', [
            'video' => $video
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Video $video) {
        return view('video-admin::edit', [
            'video' => $video,
            'states' => VideoStateProxy::choices()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Video $video, UpdateVideo $request) {
        try {
            $video->update($request->all());
            if ($request->has('url') && !empty($request->input('url'))) {
                if ($request->input('url') == $video->url) {
                    
                } else {
                    $videoUrl = $request->input('url');

                    // Extract the video ID from the URL
                    $videoId = Youtube::parseVidFromURL($videoUrl);

                    // Fetch video data
                    $videoData = Youtube::getVideoInfo($videoId);
                    $embedid = $videoData->id;

                    // Extract the URL from the embed HTML
                    // Access the desired properties from the video data
                    $title = $videoData->snippet->title;
                    $description = $videoData->snippet->description;
                    $thumbnailUrl = $videoData->snippet->thumbnails->maxres->url;
                    $video->name = $title;
                    $video->url = $request->input('url');
                    $video->service = 'youtube';
                    $video->service_id = $embedid;
                    $video->description = $description;
                    $video->is_upload = false;
                    $post->slug = null;
                    $video->save();
                }
            }

            flash()->success(__(':name has been updated', ['name' => $video->name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }

        return back()->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Video $video) {
        try {
            $name = $video->name;
            $video->delete();

            flash()->warning(__(':name has been deleted', ['name' => $name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back();
        }

        return redirect(route('video.admin.index'));
    }

}
