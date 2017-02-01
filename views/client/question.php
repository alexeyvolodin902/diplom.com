<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 28.01.17
 * Time: 19:26
 */
include_once ROOT . '/views/modules/header.php';
?>
    <a href="index" id="goHomeClient" class="grayButton">&#8592 Назад</a>

    <main>
        <div id="questionForm">
            <form method="post" enctype="multipart/form-data" method="POST"
                  action="javascript:void(null);"
                  onsubmit="send()">
                <label for="region">Выберите ваш район или город</label><br>
                <select name="region">
                    <option disabled selected>Выберите ваш район или город</option>
                    <?php
                    foreach ($regions as $region):?>
                        <option value="<?php echo $region['id']?>"> <?php echo $region['name']?></option>
                    <?php endforeach; ?>
                </select>
                <div class="errorForm" id="questionFormErrorRegion"><br></div>

                <label for="name">Имя и фамилия</label><br><input type="text" id="name" name="name">
                <div class="errorForm" id="questionFormErrorName"><br></div>

                <label for="email">Email</label><br><input type="text" id="email" name="email">
                <div class="errorForm" id="questionFormErrorEmail"><br></div>
                <label for="question">Вопрос</label> <br><textarea id="question" name="question"></textarea>
                <div class="errorForm" id="questionFormErrorQuestion"><br></div>
                <input type="hidden" name="MAX_FILE_SIZE" value="21000000"/>
                <label for="addedFile">Вы можете прикрепить изображение, zip-архив или PDF файл</label><br>
                <input name="addedFile" id="addedFile" type="file"
                       accept="application/zip,  application/pdf, image/*"><br>
                <button class="greenButton">Отправить</button>
            </form>
        </div>
        <div id="loader">
            <img src="../includes/img/load.svg" height="100">
        </div>
        <div id="completeQuestion">
            <h2>Спасибо за ваш вопрос!</h2>
            <p>Наши специалисты отправят ответ на <span id="emailSend"></span> в ближайшее время.</p>

        </div>

    </main>

    <script type="text/javascript" src="../includes/js/jQuery.js"></script>
    <script type="text/javascript" src="../includes/js/validator.min.js"></script>
    <script type="text/javascript" src="../includes/js/script.js"></script>
    <script>


        var inputName = $("#name");
        var inputEmail = $("#email");
        var inputQuestion = $("#question");
        var inputRegion = ($("select"));
        var errorName = $("#questionFormErrorName");
        var errorEmail = $("#questionFormErrorEmail");
        var errorQuestion = $("#questionFormErrorQuestion");
        var errorRegion = $("#questionFormErrorRegion");
        var loader = $("#loader");
        var goHomeButton = $("#goHomeClient");


        inputName.focusin(function () {
            errorName.html("<br>");
            addGrayBorder(inputName);
        });

        inputEmail.focusin(function () {
            errorEmail.html("<br>");
            addGrayBorder(inputEmail)
        });

        inputQuestion.focusin(function () {
            errorQuestion.html("<br>");
            addGrayBorder(inputQuestion);
        });

        inputRegion.focusin(function () {
            errorRegion.html("<br>");
            addGrayBorder(inputRegion);
        });

        function send() {
            errorName.html("<br>");
            errorEmail.html("<br>");
            errorQuestion.html("<br>");
            errorRegion.html("<br>");
            var flErrorName = false;
            var flErrorEmail = false;
            var flErrorQuestion = false;
            var flErrorRegion = false;

            if (!checkEmpty(inputName)) {
                flErrorName = true;
                addErrorEmpty(errorName);
                addRedBorder(inputName);
            }
            if (!checkEmpty(inputEmail)) {
                flErrorEmail = true;
                addErrorEmpty(errorEmail);
                addRedBorder(inputEmail);

            }

            if (!checkEmpty(inputQuestion)) {
                flErrorQuestion = true;
                addErrorEmpty(errorQuestion);
                addRedBorder(inputQuestion);
            }

            if (!validator.isEmail(inputEmail.val(), {allow_utf8_local_part: false}) && flErrorEmail == false) {
                flErrorEmail = true;
                errorEmail.html("Пожалуйста, введите корректный email");
                addRedBorder(inputEmail);
            }
            if (inputRegion.val() == null) {
                flErrorRegion = true;
                errorRegion.html("Пожалуйста, выберите ваш район или город");
                addRedBorder(inputRegion);
            }

            if (!flErrorName && !flErrorEmail && !flErrorQuestion) {
                $("#questionForm").hide();
                goHomeButton.hide();
                loader.show();

                var formData = new FormData($('form')[0]);

                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "/addQuestion",
                    data: formData
                })

                    .done(function () {
                        loader.hide();
                        goHomeButton.show();
                        $("#completeQuestion").show();
                        $("#emailSend").html(inputEmail.val());

                    });

            }
        }


    </script>


<?php
include_once ROOT . '/views/modules/footer.php';
