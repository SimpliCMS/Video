<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">
                {!! icon('product') !!}
            </span>
        </span>
        {{ Form::text('name', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => __('Video name')
            ])
        }}
        @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">
                {!! icon('product') !!}
            </span>
        </span>
        {{ Form::text('url', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('url') ? ' is-invalid' : ''),
                'placeholder' => __('Video URL Leave blank for Upload')
            ])
        }}
        @if ($errors->has('url'))
        <div class="invalid-feedback">{{ $errors->first('url') }}</div>
        @endif
    </div>
</div>

<hr>
<div class="form-group row">
    <label class="col-md-2">{{ __('State') }}</label>
    <div class="col-md-10">
        <?php /* $errors->has('state') ? ' is-invalid' : ''; */ ?>

        @foreach($states as $key => $value)
        <label class="radio-inline" for="state_{{ $key }}">
            {{ Form::radio('state', $key, $video->state === $key, ['id' => "state_$key"]) }}
            {{ $value }}
            &nbsp;
        </label>
        @endforeach


    </div>
</div>
@if ($errors->has('state'))
<div class="alert alert-danger">{{ $errors->first('state') }}</div>
@endif
<hr>
<div class="form-group">
    <label>{{ __('Description (Leave Blank for url based video)') }}</label>

    <textarea class="form-control" id="description" name="description" rows="10">{{ $video->description }}</textarea>

    @if ($errors->has('description'))
    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
    @endif
</div>
<hr>
<div class="form-group">
    <?php $seoHasErrors = any_key_exists($errors->toArray(), ['ext_title', 'meta_description', 'meta_keywords']) ?>
    <h5><a data-toggle="collapse" href="#bookable-form-seo" class="collapse-toggler-heading"
           @if ($seoHasErrors)
           aria-expanded="true"
           @endif
           >{!! icon('>') !!} {{ __('SEO') }}</a></h5>

    <div id="bookable-form-seo" class="collapse{{ $seoHasErrors ? ' show' : '' }}">
        <div class="callout">

            @include('video-admin::partials.form._form_seo')

        </div>
    </div>
</div>

<div class="form-group">
    <?php $extraHasErrors = any_key_exists($errors->toArray(), ['slug', 'excerpt']) ?>
    <h5><a data-toggle="collapse" href="#bookable-form-extra" class="collapse-toggler-heading"
           @if ($extraHasErrors)
           aria-expanded="true"
           @endif
           >{!! icon('>') !!} {{ __('Extra Settings') }}</a></h5>

    <div id="bookable-form-extra" class="collapse{{ $extraHasErrors ? ' show' : '' }}">
        <div class="callout">

            @include('video-admin::partials.form._form_extra')

        </div>
    </div>
</div>