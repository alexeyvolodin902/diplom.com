<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 15:02
 */

include_once ROOT . '/views/modules/header.php';

?>
    <a href="/" id="backToSite" class="grayButton">Вернуться на главную страницу</a>
    <main>

        <div id="authForm">
            <?php
            if ($error):
                ?>
                <div id="authFormError"><p>Неверный логин или пароль <br>
                        <span id="extra">Проверьте введенные данные или обратитесь к администратору</span></p></div>
            <?php endif; ?>
            <form method="post" action="/auth">
                <label for="login">Логин</label><br><input type="text" id="login" name="login"><br>
                <label for="password">Пароль</label> <br><input type="password" id="password" name="password"><br>
                <button class="greenButton">Войти</button>
            </form>
        </div>
    </main>

<?php
include_once ROOT . '/views/modules/footer.php';