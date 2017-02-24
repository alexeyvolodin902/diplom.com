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
    <a href="../passports" id="buttonBack" class="grayButton">&#8592 Назад</a>
    <h3>Редактирование технического паспорта</h3>

    <main>
        <div id="passportInfo">
            <span>регистрационный номер: <?php echo $id ?></span>
            <span><?php echo $info['city'] ?></span><br>
            <span><?php echo $info['street']." "; ?> <?php echo $info['num_home'] ?></span>
            <span><?php echo $info['name_object'] ?></span>


        </div>
        <div id="editMenuList">
            <a href="../passportEditGeneral/<?php echo $id ?>">Общие сведения</a>
            <a href="../passportEditCharacter/<?php echo $id ?>" class="<?php
            if (!$status['fullComposition'])
                echo "gray";
            else echo "green";
            ?>
             ">Характеристики объекта</a>
            <a href="#" class="gray">Состав объекта</a>
            <a href="#" class="gray">Сведения о правообладателях объекта</a>
            <a href="#" class="gray">Ситуационный план</a>
            <a href="#" class="gray">Благоустройство объекта</a>
            <a href="#" class="gray">Поэтажный план</a>
            <a href="#" class="gray">Экспликация к поэтажному плану</a>
            <a href="#" class="gray">Отметки об обследованиях</a>
        </div>
    </main>
<?php
include_once ROOT . '/views/modules/footer.php';
