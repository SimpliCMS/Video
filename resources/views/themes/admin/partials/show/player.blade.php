@push('style')
<link rel="stylesheet" href="{{ url('modules/Video/resources/assets/plyr/plyr.css') }}">
@endpush
<div class="plyr__video-embed" id="player">
  <iframe
    src="https://www.youtube.com/embed/{{ $video->service_id }}?autoplay=1&origin={{ url('') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
    allowfullscreen
    allowtransparency
    allow="autoplay"
  ></iframe>
</div>
@push('scripts')
<script src="{{ url('modules/Video/resources/assets/plyr/plyr.js') }}"></script>
<script>
const player = new Plyr('#player');
player.on('ready', (event) => {
    player.play();
});
</script>
@endpush