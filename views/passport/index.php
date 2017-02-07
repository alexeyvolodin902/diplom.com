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

    <a href="admin" id="buttonBack" class="grayButton">&#8592 Назад</a>
    <h3>Технические паспорта</h3>
    <main>

        <menu>
            <a href="#" class="menuItem firstRow menuAdmin2">
                <div>Просмотр</div>
            </a>
            <a href="passportsAddMenu" class="menuItem firstRow menuAdmin2">
                <div>Добавить</div>
            </a>
            <a href="" class="menuItem firstRow menuAdmin2">
                <div>Статистика</div>
            </a>
        </menu>
    </main>
<?php
include_once ROOT . '/views/modules/footer.php';


