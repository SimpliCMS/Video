@extends('layouts.master')
@section('title')
Videos
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-3">

        </div>
        <div class="col-12 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($videos->sortByDesc('created_at') as $video)
                        @if ($video->is_active)
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-3">
                                <a href="{{ route('video.show', $video->id) }}"><img src="{{ $video->getMedia('service_image')[0]->getUrl() }}" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <p class="card-text"><a href="{{ route('video.show', $video->id) }}">{{ Str::limit($video->name, 50) }}</a></p>
                                    <p class="card-text">{{ $video->user->username }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection