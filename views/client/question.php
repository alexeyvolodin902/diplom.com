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
                  onsubmit="call()">
                <label for="name">Имя</label><br><input type="text" id="name" name="name">
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

        inputName.focusin(function () {
            errorName.html("<br>");
            inputName.css("border", "1px solid #ccc");

        });
        inputEmail.focusin(function () {
            errorEmail.html("<br>");
            inputEmail.css("border", "1px solid #ccc");
        });
        inputQuestion.focusin(function () {
            errorQuestion.html("<br>");
            inputQuestion.css("border", "1px solid #ccc");
        });

        function call() {
            errorName.html("<br>");
            errorEmail.html("<br>");
            errorQuestion.html("<br>");
            var flErrorName = false;
            var flErrorEmail = false;
            var flErrorQuestion = false;

            if (!checkEmpty(inputName)) {
                flErrorName = true;
                errorName.html("Пожалуйста, заполните это поле");
                inputName.css("border", "1px solid red");
            }
            if (!checkEmpty(inputEmail)) {
                flErrorEmail = true;
                errorEmail.html("Пожалуйста, заполните это поле");
                inputEmail.css("border", "1px solid red");

            }

            if (!checkEmpty(inputQuestion)) {
                flErrorQuestion = true;
                errorQuestion.html("Пожалуйста, заполните это поле");
                inputQuestion.css("border", "1px solid red");
            }

            if (!validator.isEmail(inputEmail.val()) && flErrorEmail == false) {
                flErrorEmail = true;
                errorEmail.html("Пожалуйста, введите корректный email");
                inputEmail.css("border", "1px solid red");
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
                    .done(function (data) {

                        alert("Jr");
                    });
            }
        }
    </script>


<?php
include_once ROOT . '/views/layouts/footer.php';
