<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $option = new Option();
        $option->key = 'О нас';
        $option->ru_value = 'Neo Universe - это международная фармацевтическая компания, которая производит и продвигает рецептурные и безрецептурные лекарства, основанная в 2001 году, с целью внедрения инноваций в медицине. Мы специлиазируемся в таких областях как: кардиология, терапия, педиатрия, гинекология, дерматология, эндокринология, неврология, урология, пульмонология, гематология, микробиология, иммунология, аллергология, альгология и травматология.';
        $option->en_value = 'Neo Universe - это международная фармацевтическая компания, которая производит и продвигает рецептурные и безрецептурные лекарства, основанная в 2001 году, с целью внедрения инноваций в медицине. Мы специлиазируемся в таких областях как: кардиология, терапия, педиатрия, гинекология, дерматология, эндокринология, неврология, урология, пульмонология, гематология, микробиология, иммунология, аллергология, альгология и травматология.';
        $option->ka_value = 'Neo Universe - это международная фармацевтическая компания, которая производит и продвигает рецептурные и безрецептурные лекарства, основанная в 2001 году, с целью внедрения инноваций в медицине. Мы специлиазируемся в таких областях как: кардиология, терапия, педиатрия, гинекология, дерматология, эндокринология, неврология, урология, пульмонология, гематология, микробиология, иммунология, аллергология, альгология и травматология.';
        $option->tag = 'about-us';
        $option->save();

        // ---------Footer start---------
        $option = new Option();
        $option->key = 'Фейсбук';
        $option->ru_value = 'https://www.facebook.com/';
        $option->en_value = 'https://www.facebook.com/';
        $option->ka_value = 'https://www.facebook.com/';
        $option->tag = 'facebook';
        $option->save();

        $option = new Option();
        $option->key = 'Инстаграм';
        $option->ru_value = 'https://www.instagram.com/';
        $option->en_value = 'https://www.instagram.com/';
        $option->ka_value = 'https://www.instagram.com/';
        $option->tag = 'instagram';
        $option->save();

        $option = new Option();
        $option->key = 'Адрес';
        $option->ru_value = '«Neo Universe» Unit 18, 53 Norman Road, Greenwich Centre Business Park, London, England, SE10 9QF';
        $option->en_value = '«Neo Universe» Unit 18, 53 Norman Road, Greenwich Centre Business Park, London, England, SE10 9QF';
        $option->ka_value = '«Neo Universe» Unit 18, 53 Norman Road, Greenwich Centre Business Park, London, England, SE10 9QF';
        $option->tag = 'address';
        $option->save();

        $option = new Option();
        $option->key = 'Почта';
        $option->ru_value = 'info@neouniverse.co.uk';
        $option->en_value = 'info@neouniverse.co.uk';
        $option->ka_value = 'info@neouniverse.co.uk';
        $option->tag = 'email';
        $option->save();

        $option = new Option();
        $option->key = 'Телефон';
        $option->ru_value = '+992 918 55 64 64';
        $option->en_value = '+992 918 55 64 64';
        $option->ka_value = '+992 918 55 64 64';
        $option->tag = 'phone';
        $option->save();
        // ---------Footer end---------


        $option = new Option();
        $option->key = 'Телефон';
        $option->ru_value = '<p>Neo Universe – международная фармацевтическая компания, основанная в 2001 году. Основа нашей деятельности  – внедрение инноваций, которые будут приносить пользу всем людям.</p>
        <p>В результате нашей активной деятельности, врачи и медицинские представители имеют доступ к широкому спектру лекарств и возможность выбирать их для конкретных пациентов. Они получают от наших сотрудников достоверную и исчерпывающую информацию о новых разработках в области современной медицины.</p>
        <p>Мы уверены: медицина и лекарства должны быть доступны каждому, кто в них нуждается ― независимо от дохода, состояния национальной экономики и системы здравоохранения. Поэтому мы стремимся обеспечить насколько можно доступ к жизненно важным препаратам.</p>';
        $option->en_value = '<p>Neo Universe – международная фармацевтическая компания, основанная в 2001 году. Основа нашей деятельности  – внедрение инноваций, которые будут приносить пользу всем людям.</p>
        <p>В результате нашей активной деятельности, врачи и медицинские представители имеют доступ к широкому спектру лекарств и возможность выбирать их для конкретных пациентов. Они получают от наших сотрудников достоверную и исчерпывающую информацию о новых разработках в области современной медицины.</p>
        <p>Мы уверены: медицина и лекарства должны быть доступны каждому, кто в них нуждается ― независимо от дохода, состояния национальной экономики и системы здравоохранения. Поэтому мы стремимся обеспечить насколько можно доступ к жизненно важным препаратам.</p>';
        $option->ka_value = '<p>Neo Universe – международная фармацевтическая компания, основанная в 2001 году. Основа нашей деятельности  – внедрение инноваций, которые будут приносить пользу всем людям.</p>
        <p>В результате нашей активной деятельности, врачи и медицинские представители имеют доступ к широкому спектру лекарств и возможность выбирать их для конкретных пациентов. Они получают от наших сотрудников достоверную и исчерпывающую информацию о новых разработках в области современной медицины.</p>
        <p>Мы уверены: медицина и лекарства должны быть доступны каждому, кто в них нуждается ― независимо от дохода, состояния национальной экономики и системы здравоохранения. Поэтому мы стремимся обеспечить насколько можно доступ к жизненно важным препаратам.</p>';
        $option->tag = 'about-company';
        $option->save();



        //-------------Мы ценим-------------
        $option = new Option();
        $option->key = 'Здоровье';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'wealth-health';
        $option->save();

        $option = new Option();
        $option->key = 'Эффективность в работе';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'wealth-efficiency ';
        $option->save();

        $option = new Option();
        $option->key = 'Уверенность';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'wealth-confidence';
        $option->save();

        $option = new Option();
        $option->key = 'Обязанность';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'wealth-duty';
        $option->save();
        //-------------Мы ценим end-------------


        //-------------наша основа-------------
        $option = new Option();
        $option->key = 'Стратегия';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'base-strategy';
        $option->save();

        $option = new Option();
        $option->key = 'Миссия';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'base-mission ';
        $option->save();

        $option = new Option();
        $option->key = 'Цель';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'base-aim';
        $option->save();

        $option = new Option();
        $option->key = 'Ценность';
        $option->ru_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->en_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->ka_value = 'В своей ежедневной работе Neo Universe следует нескольким золотым правилам и ценностям. Эти значения определяют, насколько мы успешны в той сфере, в которой мы работаем.';
        $option->tag = 'base-wealth';
        $option->save();
        //-------------наша основа end-------------



        $option = new Option();
        $option->key = 'О нашей продукции';
        $option->ru_value = 'В настоящее время фармацевтический портфель нашей компании состоит из более 100 продуктов, представленных в различных формах производства и дозировки. Все лекарства производятся на фабриках с мировой репутацией надежных и высокотехнологичных производителей, работающих в соответствии со стандартами GMP.';
        $option->en_value = 'В настоящее время фармацевтический портфель нашей компании состоит из более 100 продуктов, представленных в различных формах производства и дозировки. Все лекарства производятся на фабриках с мировой репутацией надежных и высокотехнологичных производителей, работающих в соответствии со стандартами GMP.';
        $option->ka_value = 'В настоящее время фармацевтический портфель нашей компании состоит из более 100 продуктов, представленных в различных формах производства и дозировки. Все лекарства производятся на фабриках с мировой репутацией надежных и высокотехнологичных производителей, работающих в соответствии со стандартами GMP.';
        $option->tag = 'about-products';
        $option->save();

        $option = new Option();
        $option->key = 'Внимание';
        $option->ru_value = 'Информация, представленная на сайте, не должна использоваться для самостоятельной диагностики и лечения и не может служить заменой очной консультации врача.';
        $option->en_value = 'Информация, представленная на сайте, не должна использоваться для самостоятельной диагностики и лечения и не может служить заменой очной консультации врача.';
        $option->ka_value = 'Информация, представленная на сайте, не должна использоваться для самостоятельной диагностики и лечения и не может служить заменой очной консультации врача.';
        $option->tag = 'products-warning';
        $option->save();

    }
}
