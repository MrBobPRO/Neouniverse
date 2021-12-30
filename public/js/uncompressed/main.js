// ----------------Main carousel start----------------
let main_carousel = $("#main_carousel");
if (main_carousel) {
    main_carousel.owlCarousel({
        loop: true,
        margin: 30,
        autoplay: false,
        // autoplaySpeed: 2000,
        // autoplayTimeout: 8000,
        nav: false,
        dots: false,
        items: 3,
        autoWidth: true,
        center: true
    });

    // Owl carousel navigations
    let owl_nav_prev = document.getElementsByClassName("main-carousel__owl-nav--prev");
    for (nav of owl_nav_prev) {
        nav.addEventListener("click", function () {
            main_carousel.trigger('prev.owl.carousel');
        });
    }

    let owl_nav_next = document.getElementsByClassName("main-carousel__owl-nav--next");
    for (nav of owl_nav_next) {
        nav.addEventListener("click", function () {
            main_carousel.trigger('next.owl.carousel');
        });
    }
}

// ----------------Main carousel end----------------


// ----------------Products carousel start----------------
let products_carousel = $("#products_carousel");
if (products_carousel) {
    products_carousel.owlCarousel({
        loop: true,
        margin: 30,
        autoplay: false,
        nav: false,
        dots: false,
        items: 4,
    });

    // Owl carousel navigations
    let owl_nav_prev = document.getElementsByClassName("products-carousel__owl-nav--prev");
    for (nav of owl_nav_prev) {
        nav.addEventListener("click", function () {
            products_carousel.trigger('prev.owl.carousel');
        });
    }

    let owl_nav_next = document.getElementsByClassName("products-carousel__owl-nav--next");
    for (nav of owl_nav_next) {
        nav.addEventListener("click", function () {
            products_carousel.trigger('next.owl.carousel');
        });
    }
}

// ----------------Main carousel end----------------


// --------------Google Maps start----------------
let map = document.getElementById("map");
if (map) {
    let map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat:38.57949484167983, 
                lng: 68.73690763576408
            },
            zoom: 14,
            mapTypeControl: false,
            streetViewControl: false
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            position: {
                lat: 38.578065,
                lng: 68.750778
            },
            icon: '/img/main/marker.svg'
        });
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
}
// --------------Google Maps end----------------
