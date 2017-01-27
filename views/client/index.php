<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 25.01.17
 * Time: 13:30
 */


include_once ROOT.'/views/layouts/header.php';
?>
<a href="/auth" id="signIn">Вход</a>
<main>
    <menu>
        <a href="#" class="menuItem firstRow">
            <div>Справка о площади</div>
        </a>
        <a href="#" class="menuItem firstRow">
            <div>Справка об инвентаризационной стоимости</div>
        </a>
        <a href="#" class="menuItem firstRow">
            <div>Справка о регистрации собственности</div>
        </a>
        <a href="#" class="menuItem secondRow">
            <div>Узнать статус заявки</div>
        </a>
        <a href="#" class="menuItem secondRow">
            <div>Задать вопрос</div>
        </a>
        <a href="#" class="menuItem secondRow">
            <div>Контакты</div>
        </a>
    </menu>
    <section>
        <h1>С помощью данного сервиса вы сможете:</h1>
        <ul>
            <li>Оставить заявку на получение справки о характеристиках объекта недвижимости без очередей и ожидания </li>
            <li>Оставить заявку на получение справки о наличии собственности у физического лица </li>
            <li>Узнать статус своей заявки на получение справки</li>
            <li>Задать любой интересующий вас вопрос нашим специалистам</li>
        </ul>
    </section>
</main>
<?php
include_once ROOT.'/views/layouts/footer.php';
?>
