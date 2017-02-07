<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 01.02.17
 * Time: 12:52
 */
include_once ROOT . '/views/modules/header.php';
include_once ROOT . '/views/modules/userInfo.php';
?>
    <a href="admin" id="buttonBack" class="grayButton">&#8592 Назад</a>
    
    <main>

        <div id="accessError">
            <h1>Отказано в доступе</h1>
            <p>Авторизуйтесь под другим пользователем или обратитесь к администратору </p>
        </div>
    </main>
<?php
include_once ROOT . '/views/modules/footer.php';
?>