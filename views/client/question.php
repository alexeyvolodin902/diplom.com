<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 28.01.17
 * Time: 19:26
 */
include_once ROOT . '/views/layouts/header.php';
?>
    <a href="index" id="goHomeClient" class="grayButton">&#8592 Назад</a>

    <main>
        <div id="questionForm">
            <form method="post" enctype="multipart/form-data" method="POST"
                  action="javascript:void(null);"
                  onsubmit="send()">
                <label for="name">Имя и фамилия</label><br><input type="text" id="name" name="name">
                <div class="errorForm" id="questionFormErrorName"><br></div>

                <label for="email">Email</label><br><input type="email" id="email" name="email">
                <div class="errorForm" id="questionFormErrorEmail"><br></div>
                <label for="question">Вопрос</label> <br><textarea id="question" name="question"></textarea>
                <div class="errorForm" id="questionFormErrorQuestion"><br></div>
                <input type="hidden" name="MAX_FILE_SIZE" value="21000000"/>
                <label for="addedFile">Вы можете прикрепить изображение, zip-архив или PDF файл</label><br>
                <input name="addedFile" id="addedFile" type="file"
                       accept="application/x-compressed, application/pdf, image/*"><br>
                <button class="greenButton">Отправить</button>
            </form>
        </div>
        <div id="completeQuestion">
            <h1>Спасибо за ваш вопрос!</h1>
            <p>Наши специалисты пришлют ответ на <span id="emailSend"></span> в ближайшее время.</p>

        </div>
    </main>
    <script type="text/javascript" src="../template/js/validator.min.js"></script>
    <script>
        var inputName = $("#name");
        var inputEmail = $("#email");
        var inputQuestion = $("#question");
        var errorName = $("#questionFormErrorName");
        var errorEmail = $("#questionFormErrorEmail");
        var errorQuestion = $("#questionFormErrorQuestion");

        function checkEmpty(input) {
            return !(input.val() == "");
        }

        function addErrorEmpty(obj) {
            obj.html("Пожалуйста, заполните это поле");
        }

        function addRedBorder(obj) {
            obj.css("border", "1px solid red");
        }

        function addGrayBorder(obj) {
            obj.css("border", "1px solid #ccc");
        }


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

        function send() {
            errorName.html("<br>");
            errorEmail.html("<br>");
            errorQuestion.html("<br>");
            var flErrorName = false;
            var flErrorEmail = false;
            var flErrorQuestion = false;

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

            if (!validator.isEmail(inputEmail.val()) && flErrorEmail == false) {
                flErrorEmail = true;
                errorEmail.html("Пожалуйста, введите корректный email");
                addRedBorder(inputEmail);
            }

            if (!flErrorName && !flErrorEmail && !flErrorQuestion) {
                var formData = new FormData($('form')[0]);

                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "/auth",
                    data: formData
                })
                    .done(function () {
                        $("#questionForm").hide();
                        $("#completeQuestion").show();
                        $("#emailSend").html(inputEmail.val());
                    });
            }
        }

    </script>


<?php
include_once ROOT . '/views/layouts/footer.php';
