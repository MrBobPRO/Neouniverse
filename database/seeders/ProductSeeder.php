<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed products table
     *
     * @return void
     */
    public function run()
    {
        $name = ['Амброксол', 'М2-Гино', 'Гоназа Ампулы', 'Аргумел Коби'];
        $description = '<p>Амброксол (активный метаболит бромгексина) является муколитическим средством, который улучшает реологические свойства мокроты, уменьшает ее вязкость и адгезивные свойства, что способствует ее выведению из дыхательных путей.</p>';
        $composition = '<p>Каждые 5 мл содержат: амброксола гидрохлорид BP 15 мг.</p>';
        $testimony = '<p>Амброксол применяется при заболеваниях дыхательных путей с выделением вязкой мокроты, и при затруднении отделения мокроты</p>:
        <ul>
        <li>острые и хронические бронхиты;</li>
        <li>пневмония;</li>
        <li>бронхиальная астма;</li>
        <li>бронхоэктатическая болезнь.</li>
        </ul>';
        $use = '<p>Внутрь, сироп Амброксол, принимают после еды с достаточным количеством жидкости (например, вода, сок или чай) с помощью прилагаемого мерного стаканчика.
        Обычно используются следующие дозировки:</p>
        <p>Детям до 2-х лет по 7,5мг – 2 раза в день (15 мг/сутки);</p>
        <p>Детям от 2 до 6 лет по 7,5 мг – 3 раза в день (22,5 мг/сутки);</p>
        <p>Дети от 6 до 12 лет по 15 мг – 2-3 раза в день (30-45 мг/сутки);</p>
        <p>Взрослым и подросткам в первые 2-3 дня лечения принимать по 30 мг – 3 раза в сутки (90 мг/ сутки), в последующие дни 2 раза в день (60 мг/сутки);</p>
        <p>Лечение детей до 2-х лет проводится только под контролем врача;</p>
        <p>Во время приема сиропа Амброксол, рекомендуется обильное питье; Не рекомендуется применять без врачебного назначения более, чем в течение 4-5 дней.</p>';


        for($i = 0; $i < count($name); $i++) {
            $product = new Product();
            $product->name = $name[$i];
            $product->url = Helper::transliterateIntoLatin($name[$i]);
            $product->form = '5 МЛ';
            $product->image = Helper::transliterateIntoLatin($name[$i]) . '.png';
            $product->prescription = rand(0,1);
            $product->instruction = Helper::transliterateIntoLatin($name[$i]) . '.pdf';
            $product->obtain_link = 'https://salomat.tj/';
            $product->description = $description;
            $product->composition = $composition;
            $product->testimony = $testimony;
            $product->use = $use;
            $product->save();
        }
    }
}
