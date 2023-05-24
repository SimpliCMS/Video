@extends('layouts.master')
@section('title')
{{ $video->title }}
@stop
@section('content')
@push('style')
<link rel="stylesheet" href="{{ url('modules/Video/resources/assets/plyr/plyr.css') }}">
@endpush
<div class="container">
    <div class="row">
        <div class="col-13 col-lg-9 col-xl-10">
            @include('video::partials.show.player')
            @include('video::partials.show.channel')
            @include('video::partials.show.description')
        </div>
        
        <div class="col-11 col-lg-7 col-xl-8">
            @include('comment::comments', ['type' => 'video', 'type_id' => $video->id, 'comments' => $video->comments])
        </div>
    </div>
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
@endsection

