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
                    echo "<a href =" . $href . " id=\"addedFile\" target=\"_blank\">Прикрепленный " . $question['type_file'] . " файл" . "</a>";
                }

                ?>

        </div>
        <?php if(empty($question['answer'])): ?>
        <div id="answerQuestion">

            <textarea id="textarea" placeholder="Введите ответ"></textarea>
            <div id="deleteButtons">
                <a href="" class="redButton">Удалить</a>
                <a href="" class="grayButton">Отметить как прочитанное</a>
            </div>
            <div id="answerButton">

                <a href="" class="greenButton">Ответить</a>
            </div>
        </div>
        <?php else: ?>
        <div id="answerText">
            <?php echo $userAnswer;?>
            <p>
                <?php

                echo $question['answer'];?>
            </p>
        </div>

        <?php endif; ?>


    </main>

    <script type="text/javascript" src="../includes/js/jQuery.js"></script>
    <script>
        var inputAnswer = document.getElementById('textarea');
        var buttonDelete = $("#deleteButtons");
        var buttonAnswer = $("#answerButton");
        buttonAnswer.hide();
        inputAnswer.oninput = function () {
            if (inputAnswer.value != "") {
                buttonDelete.hide();
                buttonAnswer.show();
            }
            else {
                buttonAnswer.hide();
                buttonDelete.show();
            }
        };
    </script>
<?php include_once ROOT . '/views/modules/footer.php';
?>