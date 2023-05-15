
@extends('appshell::layouts.private')
@section('title')
{{ __('Videos') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Videos

            <div class="card-actionbar">
                <div class="btn-group">
                    <a href="{{ route('video.admin.create') }}" class="btn btn-sm btn-outline-success">
                        <i class="zmdi zmdi-plus " ></i>
                        Add/Upload Video
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <td><a href="{{ route('video.admin.show', $video->id) }}">{{ $video->title }}</a></td>
                        <td>{{ $video->slug }}</td>
                        <td>
                            <a href="{{ route('video.admin.edit', $video->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('video.admin.destroy', $video->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection