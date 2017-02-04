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
            <span id="questionTime">Дата и время: <b>
                    <?php echo strftime(" %e %B %Y %R", strtotime($question['dateTime']));
                    ?></b></span>
        </div>
        <div id="questionText">
            <p><?php
                echo $question['question'];
                echo "</p><br>";
                if (!empty($question['type_file'])) {
                    $href = "../media/questionFiles/" . $question['id'] . "." . $question['type_file'];
                    echo "<a href =" . $href . " id=\"addedFile\" target=\"_blank\">Прикрепленный " . $question['type_file'] . " файл" . "</a>";
                }
                echo "<span id=\"questionEmail\">" . $question['email'] . "</span><br>";

                ?>

        </div>
        <div id="successDelete"></div>
        <?php if ($question['status'] == 0): ?>
            <!--неотвеченный вопрос-->
            <div id="answerQuestion">

                <textarea id="textarea" placeholder="Введите ответ"></textarea>
                <div class="extraButtons">
                    <a id="deleteQuestionButton" class="redButton">Удалить</a>
                    <a id="markAnsweredButton" class="grayButton">Отметить как отвеченный</a>
                </div>
                <div id="answerButton">
                    <a id="answerMessageButton" class="greenButton">Ответить</a>
                </div>
            </div>

        <?php elseif (!empty($question['answer'])): ?>
            <!--отвеченный вопрос-->
            <div id="answerText">
                <p>
                    <?php
                    echo "<b>" . $userAnswer . ":</b><br>";
                    echo $question['answer']; ?>
                </p>
            </div>

            <div class="extraButtons">
                <a id="deleteQuestionButton" class="redButton">Удалить</a>
            </div>
        <?php else: ?>
            <!--Помеченный как отвеченный вопрос-->
            <div id="messageAnswerQuestion">
                Вопрос был помечен как отвеченный пользователем: <b><?php echo $userAnswer; ?></b>
            </div>
            <div class="extraButtons">
                <a id="deleteQuestionButton" class="redButton">Удалить</a>
                <a id="markUnAnsweredButton" class="grayButton">Отметить как неотвеченный</a>
            </div>

        <?php endif; ?>


    </main>

    <script type="text/javascript" src="../includes/js/jQuery.js"></script>
    <script>
        var inputAnswer = document.getElementById('textarea');
        var buttonExtra = $(".extraButtons");
        var buttonAnswer = $("#answerButton");
        var answerMessageButton = $("#answerMessageButton");
        var markAnsweredButton = $("#markAnsweredButton");
        var markUnAnsweredButton = $("#markUnAnsweredButton");
        var deleteButton = $("#deleteQuestionButton");
        buttonAnswer.hide();

        /*Удаление вопроса*/
        deleteButton.click(function () {
            $.post(
                "../../questionDelete",
                {
                    id:<?php echo $question['id']?>
                },
                function () {
                    $("#successDelete").replaceWith("<div id=\"successAnswer\">Вопрос удален</div>");
                    $("#answerText").hide();
                    $("textarea").hide();
                    $("#messageAnswerQuestion").hide();
                    buttonExtra.hide();

                }
            );
        });
        
        /*Отметка о неотвеченном вопросе*/
        markUnAnsweredButton.click(function () {
            $.post(
                "../../questionMarkUnAnswered",
                {
                    id:<?php echo $question['id']?>,
                    idUser:<?php echo $userInfo['id']?>
                },
                function () {
                    $("#messageAnswerQuestion").replaceWith("<div id=\"successAnswer\">Вопрос помечен как неотвеченный</div>");
                    buttonExtra.hide();
                }
            );
        });

        inputAnswer.oninput = function () {
            if (inputAnswer.value != "") {
                buttonExtra.hide();
                buttonAnswer.show();
            }
            else {
                buttonAnswer.hide();
                buttonExtra.show();
            }
        };

        /*Отправка ответа на вопрос*/
        answerMessageButton.click(function () {
            $.post(
                "../../questionAddAnswer",
                {
                    id: <?php echo $question['id']?>,
                    answer: inputAnswer.value,
                    idUser:  <?php echo $userInfo['id']?>,
                    email: "<?php echo $question['email']?>"
                },
                function () {
                    $("#answerQuestion").html("<div id=\"successAnswer\">Ответ отправлен</div>");
                }
            );
        });

        /*Отметка об ответе на вопрос*/
        markAnsweredButton.click(function () {
            $.post(
                "../../questionMarkAnswered",
                {
                    id:<?php echo $question['id']?>,
                    idUser:<?php echo $userInfo['id']?>
                },
                function () {
                    $("#answerQuestion").html("<div id=\"successAnswer\">Вопрос помечен как отвеченный</div>");
                }
            );
        });


    </script>
<?php include_once ROOT . '/views/modules/footer.php';
?>