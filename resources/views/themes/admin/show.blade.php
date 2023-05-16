@extends('appshell::layouts.private')

@section('title')
{{ $video->name }}
@stop

@section('content')

<div class="row">
    <div class="col-sm-6 col-md-4 mb-3">
        @component('appshell::widgets.card_with_icon', [
        'icon' => $video->is_active ? 'product' : 'product-off',
        'type' => $video->is_active ? 'success' : 'warning'
        ])
        {{ $video->name }}
        @if (!$video->is_active)
        <small>
            <span class="badge badge-secondary">
                {{ __('inactive') }}
            </span>
        </small>
        @endif
        @slot('subtitle')
        
        @endslot
        @endcomponent
    </div>

    <div class="col-sm-6 col-md-5 mb-3">
        @component('appshell::widgets.card_with_icon', [
        'icon' => 'time',
        'type' => 'info'
        ])
        {{ $video->state }}

        @slot('subtitle')
        {{ __('Updated') }}
        {{ show_datetime($video->updated_at) }}
        |
        {{ __('Created at') }}
        {{ show_datetime($video->created_at) }}
        @endslot
        @endcomponent
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
        @component('appshell::widgets.card_with_icon', ['icon' => 'bag'])
        {{ views($video)->count() }}
        {{ __('Total Views') }}
        @slot('subtitle')

        @endslot
        @endcomponent
    </div>

    <div class="col-12 col-md-6 col-lg-8 col-xl-9 mb-3">
        @include('video-admin::partials.show.player')
    </div>

    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">

    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        @can('edit products')
        <a href="{{ route('video.admin.edit', $video) }}" class="btn btn-outline-primary">{{ __('Edit Video') }}</a>
        @endcan

        @can('delete products')
        {!! Form::open(['route' => ['video.admin.destroy', $video], 'method' => 'DELETE', 'class' => "float-right"]) !!}
        <button class="btn btn-outline-danger">
            {{ __('Delete Video') }}
        </button>
        {!! Form::close() !!}
        @endcan

    </div>
</div>

@stop