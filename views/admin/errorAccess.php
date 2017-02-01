<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 01.02.17
 * Time: 12:52
 */
include_once ROOT . '/views/modules/header.php';
?>
    <div id="userInfo">
        <span id="userName">
        <?php echo $userInfo['FIO'] ?>
        </span>
        <br>
        <div id="userExtra">
            <?php echo $userInfo['position'] ?>
            <br>

            <?php echo $userRegion ?>
        </div>
        <a href="../auth" id="logoutButton" class="redButton">Выйти</a>

    </div>
    <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" id="buttonBack" class="grayButton">&#8592 Назад</a>
    <main>

        <div id="accessError">
            <h1>Отказано в доступе</h1>
            <p>Авторизуйтесь под другим пользователем или обратитесь к администратору </p>
        </div>
    </main>
<?php
include_once ROOT . '/views/modules/footer.php';
?>