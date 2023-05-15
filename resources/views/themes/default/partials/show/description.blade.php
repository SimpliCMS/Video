<div class="card">
    <div class="card-body">
        {{ views($video)->count() }}&nbsp;views&nbsp;&nbsp;{{ $video->timeAgo() }}
        <div class="card-text" id="shortText">
            {!! Str::limit($video->description, 287) !!}
        </div>
        <div class="card-text" id="fullText">
            {!! $video->description !!}
        </div>
        <a href="#" id="viewMoreLink">View More</a>
        <a href="#" id="viewLessLink">View Less</a>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#fullText').hide();
        $('#viewLessLink').hide();
        $('#viewMoreLink').click(function (e) {
            e.preventDefault();
            $('#shortText').hide();
            $('#viewMoreLink').hide();
            $('#fullText').show();
            $('#viewLessLink').show();
        });
        $('#viewLessLink').click(function (e) {
            e.preventDefault();
            $('#shortText').show();
            $('#viewMoreLink').show();
            $('#fullText').hide();
            $('#viewLessLink').hide();
        });
    });
</script>
@endpush
