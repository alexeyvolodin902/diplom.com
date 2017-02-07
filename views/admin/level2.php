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
<main>
    <h3>Панель управления</h3>
    <menu>
        <a href="questionAdmin/1" class="menuItem firstRow menuAdmin2">
            <div>Вопросы</div>
        </a>
        <a href="#" class="menuItem firstRow menuAdmin2">
            <div>Заявки на справки</div>
        </a>
        <a href="passports" class="menuItem firstRow menuAdmin2">
            <div>Технические паспорта</div>
        </a>
    </menu>
</main>

<?php
include_once ROOT . '/views/modules/footer.php';
?>

