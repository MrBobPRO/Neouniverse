@props(['class' => '', 'new'])

<div class="news-card">
    <a class="news-card__img-container" href="#">
        <img class="news-card__image" src="{{ asset('img/news/thumbs/' . $new->image) }}" alt="{{ $new->title }}">
    </a>

    <h2 class="news-card__title">{{ $new->title }}</h2>
    <div class="news-card__body">{!! $new->body !!}</div>
    <a class="news-card__link" href="#">{{ __('Подробнее') }}</a>
</div>