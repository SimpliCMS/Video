<div class="card">
     <h3 class="text-center mt-4 mb-4">{{ Str::replaceLast('s', "'s", Str::plural($profile->person->firstname)) }}&nbsp;{{ __('Videos') }}</h3>
    <div class="card-body">
        <div class="row">
            @foreach($videos->sortByDesc('created_at') as $video)
            @if ($video->is_active)
            <div class="col-md-6 col-lg-4">
                <div class="card bg-light mb-3">
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
