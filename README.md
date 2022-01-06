<h4 align="center">Made by <a href="https://laravel.com/" target="_blank">Laravel Framework 8.76.2</a></h4> 

### Application configurations
- Timezone => Asia/Dushanbe
- Default Locale => ru
- Main Font => Roboto

### Installed Fonts, CSS & Javascript libraries
- [Roboto Google Fonts](https://fonts.google.com/specimen/Roboto)
- [Material Icons](https://fonts.google.com/icons)
- [JQuery 3.6.0](https://jquery.com/)
- [Owl Carousel](https://owlcarousel2.github.io/OwlCarousel2/)
- [Google Maps](https://developers.google.com/maps/documentation/javascript/overview)

### Installed PHP libraries
- [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits)

### Localization
1. Created Middleware "Language", that will change applications locale into sessions stored locale on app boot
2. "Language" Middleware added into App/Http/KerneL
3. Created LanguageController that will change session`s locale variable into selected language