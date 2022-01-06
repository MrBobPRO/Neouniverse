<footer class="footer">

    <div class="contact-us">
        <div class="main-container contact-us__inner" style="background-image: url({{ asset('img/main/contact-us-pattern.svg') }})">
            <h1 class="main-title contact-us__title">{{ __('Свяжитесь с нами') }}!</h1>

            <form action="#" class="contact-us__form">
                <input type="text" class="contact-us__input" placeholder="{{ __('Почта') }}">
                <input type="text" class="contact-us__input contact-us__input--grow" placeholder="{{ __('Как мы можем Вам помочь')}}?">
                <div class="button_style_more contact-us__submit">
                    <button type="submit">{{ __('Отправить') }}
                        <span class="material-icons-outlined">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($route == 'home')
        <div class="footer__news">
            <div class="footer__news-inner main-container">
                <div class="title_with_explore_more footer__news-title">
                    <h1 class="main-title">{{ __('Новости') }}</h1>
                    <a href="#">{{ __('Все новости') }} <span class="material-icons-outlined">arrow_forward</span></a>
                </div>
        
                <x-news-list :news="$news"/>
            </div>
        </div>
    @endif

    <div class="footer-map">
        <div class="main-container footer__contacts">
            <div class="footer__contacts-inner">
                <div class="footer__contacts-block">
                    <div class="footer__socials">
                        @php $facebook = App\Models\Option::where('tag', 'facebook')->first(); @endphp
                        <a href="{{ $facebook[$locale . '_value']}}" class="footer__socials-link" target="_blank">
                            @include('svgs.facebook')
                        </a>

                        @php $instagram = App\Models\Option::where('tag', 'instagram')->first(); @endphp
                        <a href="{{ $instagram[$locale . '_value']}}" class="footer__socials-link" target="_blank">
                            @include('svgs.instagram')
                        </a>
                    </div>

                    @php $address = App\Models\Option::where('tag', 'address')->first(); @endphp
                    <p class="footer__contacts-address">
                        {{ $address[$locale . '_value']}}
                    </p>

                    @php $email = App\Models\Option::where('tag', 'email')->first(); @endphp
                    <a href="mailto:{{ $email[$locale . '_value'] }}" class="footer__contacts-link">
                        {{ $email[$locale . '_value']}}
                    </a>

                    @php $phone = App\Models\Option::where('tag', 'phone')->first(); @endphp
                    <a href="tel:{{ str_replace(' ', '', $phone[$locale . '_value']) }}" class="footer__contacts-link">
                        {{ $phone[$locale . '_value']}}
                    </a>
                </div>
            </div>
        </div>

        <div id="map"></div>
    </div>

    <div class="main-container footer-bottom">
        <a href="{{ route('home') }}">
            <img class="footer__logo" src="{{ asset('img/main/logo-black.svg') }}" alt="Neo universe logo">
        </a>
        <p class="copyright">© 2012-{{date('Y')}} {{ __('NEO UNIVERSE. Все права защищены') }}</p>
    </div>
</footer>