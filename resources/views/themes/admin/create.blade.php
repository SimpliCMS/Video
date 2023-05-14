
@extends('appshell::layouts.private')
@section('title')
{{ __('Add/Upload Video') }}
@stop
@section('content')
<div class="container-fluid">
    <form action="{{ route('video.admin.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-9">
                <div class="card card-accent-success">
                    <div class="card-header">
                        Video Details
                    </div>
                    <div class="card-body">
                        @include('video-admin::partials.form._form')
                    </div>
                    <div class="card-footer">
                    <button class="btn btn-success">{{ __('Add/Upload Video') }}</button>
                    <a href="#" onclick="history.back();" class="btn btn-link text-muted">{{ __('Cancel') }}</a>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                
            </div>
    </form>
</div>
</div>
@include('core-admin::partials.tinymce._editor', ['selector' => 'description','height' => '400'])
@endsection
