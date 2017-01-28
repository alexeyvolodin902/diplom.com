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
            <form method="post" action="/auth" enctype="multipart/form-data">
                <label for="name">Имя</label><br><input type="text" id="name" name="name"><br>
                <label for="email">Email</label><br><input type="email" id="email" name="email"><br>
                <label for="question">Вопрос</label> <br><textarea id="question" name="question"></textarea><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="21000000"/>
                <label for="addedFile">Вы можете прикрепить изображение, zip-архив или PDF файл</label><br>
                <input name="addedFile" id="addedFile" type="file"
                       accept="application/x-compressed, application/pdf, image/*"><br>
                <button class="greenButton">Отправить</button>
            </form>
        </div>
    </main>


<?php
include_once ROOT . '/views/layouts/footer.php';
