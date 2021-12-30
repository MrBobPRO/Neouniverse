@extends('layouts.app')

@section('main')
<main class="main home" id="main" role="main">
    <x-main-carousel/>

    <section class="home__about">
        <div class="home__about-inner main-container">
            <div class="title_with_explore_more">
                <h1 class="main-title">О нас</h1>
                <a href="#">Подробнее о NEOUNIVERSE <span class="material-icons-outlined">arrow_forward</span></a>
            </div>

            <div class="about-cards">
                <div class="about-cards__item">
                    <p class="about-cards__counter">1</p>
                    <p class="about-cards__text">Опыт работы<br>
                        <b>с <span class="about-cards__highlight">2001</span> года</b> 
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">2</p>
                    <p class="about-cards__text">Производство по<br>
                        <b>стандартам <span class="about-cards__highlight">GMP</span></b> 
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">3</p>
                    <p class="about-cards__text">Более <b><span class="about-cards__highlight">100</span><br>
                        продуктов</b> 
                    </p>
                </div>

                <div class="about-cards__item">
                    <p class="about-cards__counter">4</p>
                    <p class="about-cards__text">Более<span class="about-cards__highlight"> <b>15</span><br>
                        категорий</b> 
                    </p>
                </div>
            </div>

            <p class="home__about-text">
                Neo Universe - это международная фармацевтическая компания, которая производит и продвигает рецептурные и безрецептурные лекарства, основанная в 2001 году, с целью внедрения инноваций в медицине. Мы специлиазируемся в таких областях как: кардиология, терапия, педиатрия, гинекология, дерматология, эндокринология, неврология, урология, пульмонология, гематология, микробиология, иммунология, аллергология, альгология и травматология.
            </p>

        </div>
    </section>

    <section class="home__products">
        <div class="home__products-inner main-container">
            <div class="title_with_explore_more home__products-title">
                <h1 class="main-title">Продукты</h1>
                <a href="#">Все продукты <span class="material-icons-outlined">arrow_forward</span></a>
            </div>
    
            <x-products-carousel :products="$products"/>
        </div>
    </section>



</main>

@endsection