<?php
/*
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 12:27
 */
include_once ROOT . '/views/modules/header.php';
include_once ROOT . '/views/modules/userInfo.php';

?>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" id="buttonBack" class="grayButton">&#8592 Назад</a>
<h3>Общие сведения</h3>
<main>
    <form action="#" id="formGeneral">
        <label for="type">Тип объекта</label><br>
        <select name="type" id="type">
            <option disabled selected>Выберите тип объекта</option>
            <?php foreach ($types AS $type):?>
                <option></option>

            <?php endforeach;?>
            </select>
        <div class="errorForm"><br></div>
        <label for="use">Назначение</label><br><input type="text" >
        <div class="errorForm"><br></div>
        <label for="email">Emdsdvsail</label><br><input type="text" name="email">
        <div class="errorForm"><br></div>
        <label for="email">Emaisdvsdvsdvsdvl</label><br><input type="text" name="email">
        <div class="errorForm"><br></div>
        <label for="email">Emai</label><br><input type="text" name="email">
        <div class="errorForm"><br></div>

    </form>
</main>

<?php
include_once ROOT . '/views/modules/footer.php';
?>
