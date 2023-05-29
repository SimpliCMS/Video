@extends('layouts.master')
@section('title')
{{ $video->title }}
@stop
@section('content')
    <div class="row">
        <div class="col-11 col-lg-8 col-xl-9">
            @include('video::partials.show.player')
            @include('video::partials.show.channel')
            @include('video::partials.show.description')
        </div>
        
        <div class="col-11 col-lg-8 col-xl-9">
            @include('comment::comments', ['type' => 'video', 'type_id' => $video->id, 'comments' => $video->comments])
        </div>
    </div>
@endsection

