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
    <main>
        <div id="questionInfo">
            <span id="questionAuthor">Автор: <b><?php echo $question['name']; ?></b></span>
            <span
                id="questionTime">Дата и время: <b>
                    <?php echo strftime(" %e %B %Y %R", strtotime($question['dateTime']));
                    ?></b></span>
        </div>
        <div id="questionText">
            <p><?php
                echo $question['question'];
                echo "</p>";
                if (!empty($question['type_file'])) {
                    $href = "../media/questionFiles/" . $question['id'] . "." . $question['type_file'];
                    echo "<a href =".$href." target=\"_blank\">Прикрепленный ". $question['type_file']." файл"."</a>";
                }

                ?>

        </div>
    </main>
<?php include_once ROOT . '/views/modules/footer.php';
?>