<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 01.02.17
 * Time: 12:42
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
<?php
foreach ($question as $part)
    echo"$part <br>";
include_once ROOT . '/views/modules/footer.php';
?>