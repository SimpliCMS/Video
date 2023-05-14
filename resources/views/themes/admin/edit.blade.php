@extends('appshell::layouts.private')

@section('title')
    {{ __('Editing') }} {{ $video->name }}
@stop

@section('content')
<div class="row">

    <div class="col-12 col-lg-8 col-xl-9">
        {!! Form::model($video, [
                'route'  => ['video.admin.update', $video],
                'method' => 'PUT'
            ])
        !!}
        <div class="card card-accent-secondary">
            <div class="card-header">
                {{ __('Video Data') }}
            </div>
            <div class="card-body">
                @include('video-admin::partials.form._form')
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">{{ __('Save') }}</button>
                <a href="#" onclick="history.back();" class="btn btn-link text-muted">{{ __('Cancel') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-12 col-lg-4 col-xl-3">
        
    </div>

</div>
@include('core-admin::partials.tinymce._editor', ['selector' => 'description','height' => '400'])
@stop