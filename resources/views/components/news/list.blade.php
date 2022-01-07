@props(['news'])

<div class="news-list">
    @foreach ($news as $new)
        <x-news.card  :new="$new"/>
    @endforeach
</div>