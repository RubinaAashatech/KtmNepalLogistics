<div class="latestnews_card">
    <h5 class="latestnews_title">Latest News</h5>

    @foreach ($news as $object)
        <ul class="latestnews_text">
            <li><a href="{{ route('render_posts', $object->id) }}">{{ $object->title }}</a></li>
        </ul>
    @endforeach

</div>