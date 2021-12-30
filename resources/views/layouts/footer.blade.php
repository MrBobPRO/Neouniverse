<footer class="footer">

    <div class="contact-us">
        <div class="main-container contact-us__inner" style="background-image: url({{ asset('img/main/contact-us-pattern.svg') }})">
            <h1 class="main-title contact-us__title">Свяжитесь с нами!</h1>

            <form action="#" class="contact-us__form">
                <input type="text" class="contact-us__input" placeholder="Почта">
                <input type="text" class="contact-us__input contact-us__input--grow" placeholder="Как мы можем Вам помочь?">
                <div class="button_style_more contact-us__submit">
                    <button type="submit">Отправить
                        <span class="material-icons-outlined">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer__news">
        <div class="footer__news-inner main-container">
            <div class="title_with_explore_more footer__news-title">
                <h1 class="main-title">Новости</h1>
                <a href="#">Все новости <span class="material-icons-outlined">arrow_forward</span></a>
            </div>
    
            {{-- <x-news-list :news="$news"/> --}}
        </div>
    </section>

    <div class="footer-map">
        <div class="main-container footer__contacts">
            <div class="footer__contacts-inner">
                <div class="footer__contacts-block">
                    <div class="footer__socials">
                        <a href="#" class="footer__socials-link">
                            @include('svgs.facebook')
                        </a>

                        <a href="#" class="footer__socials-link">
                            @include('svgs.instagram')
                        </a>
                    </div>

                    <p class="footer__contacts-address">«Neo Universe» Unit 18, 53 Norman Road, Greenwich Centre Business Park, London, England, SE10 9QF</p>
                    <a href="#" class="footer__contacts-link">info@neouniverse.co.uk</a>
                    <a href="#" class="footer__contacts-link">+992 918 55 64 64</a>
                </div>
            </div>
        </div>

        <div id="map"></div>
    </div>

    <div class="main-container footer-bottom">
        <img class="footer__logo" src="{{ asset('img/main/logo-black.svg') }}" alt="Neo universe logo">
        <p class="copyright">© 2012-2021 NEO UNIVERSE ВСЕ ПРАВА ЗАЩИЩЕНЫ</p>
    </div>
</footer>