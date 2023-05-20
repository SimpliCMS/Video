<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ $channelUser->profile->getProfileAvatar() }}" class="rounded-circle me-3" alt="Channel Avatar" width="50" height="50">
                <div>
                    <h5 class="mb-0"><a href="{{ route('profile.show', $channelUser->username) }}">{{ '@' . $channelUser->username }}</a></h5>
                    <p class="mb-0"></p>
                </div>
            </div>
            <div>
                @include('like::like', ['model' => $video])
            </div>
        </div>
    </div>
</div>