@extends('layouts.master')
@section('title')
{{ $video->title }}
@stop
@section('content')
@push('style')
<link rel="stylesheet" href="{{ url('modules/Video/resources/assets/videojs/video-js.css') }}">
@endpush
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 col-xl-9">
            @include('video::partials.show.player')
            @include('video::partials.show.channel')
             @include('video::partials.show.description')
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ url('modules/Video/resources/assets/videojs/video.min.js') }}"></script>
<script src="{{ url('modules/Video/resources/assets/videojs-youtube/dist/Youtube.min.js') }}"></script>
@endpush
@endsection
