@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.3.0/video-js.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ url('modules/Video/resources/assets/css/videjs-skin.css') }}">
@endpush

<div id="video-container">
    <video id="my-video" class="video-js vjs-default-skin" controls></video>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.3.0/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"></script>
<script>
    // Wait for the DOM to load
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the video player
        var player = videojs('my-video');
        player.autoplay(true);
        // Configure the player with the YouTube plugin
        player.ready(function () {
            player.src({
                type: 'video/youtube',
                src: 'https://www.youtube.com/watch?v={{ $video->service_id }}'
            });
            player.youtube({ ytControls: true });
        });
    });
</script>
@endpush