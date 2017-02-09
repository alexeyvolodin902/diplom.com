<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 12:27
 */
include_once ROOT . '/views/modules/header.php';
include_once ROOT . '/views/modules/userInfo.php';

?>
    <a href="passports" id="buttonBack" class="grayButton">&#8592 Назад</a>
    <h3>Добавление нового технического паспорта</h3>

<main>
    <div id="addMenuList">
        <a href="passportFormGeneral">Общие сведения</a>
        <a href="#">Состав объекта</a>
        <a href="#">Сведения о правообладателях объекта</a>
        <a href="#">Ситуационный план</a>
        <a href="#" class="gray">Благоустройство объекта</a>
        <a href="#">Поэтажный план</a>
        <a href="#">Экспликация к поэтажному плану</a>
        <a href="#" class="gray">Отметки об обследованиях</a>
    </div>
</main>
<?php
include_once ROOT . '/views/modules/footer.php';
