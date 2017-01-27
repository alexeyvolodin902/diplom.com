<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:57
 */

include_once ROOT . '/views/layouts/header.php';
?>
    <div id="userInfo">
        <span id="userName">
        <?php echo $userInfo['FIO'] ?>
        </span>
        <br>
        <div id="userExtra">
            <?php echo $userInfo['position'] ?>
            <br>

            <?php echo $userInfo['office'] ?>
        </div>
        <a href="auth" id="logoutButton" class="redButton">Выйти</a>

    </div>


<?php
include_once ROOT . '/views/layouts/footer.php';

