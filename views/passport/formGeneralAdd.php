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
<a href="../passports" id="buttonBack" class="grayButton">&#8592 Назад</a>
<h3>Общие сведения</h3>
<main>
    <form id="formGeneral" method="POST" action="javascript:void(null);" onsubmit="send()">
        <label for="type">Тип объекта</label><br>
        <select name="type" id="type">
            <option disabled selected>Выберите тип объекта</option>
            <?php foreach ($types AS $type): ?>
                <option value="<?php echo $type['id'] ?>"><?php echo $type['type'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="errorForm"><br></div>

        <label for="name">Наименование</label><br><input type="text" id="name" name="name">
        <div class="errorForm"><br></div>
        <span class="separator">Адрес</span><br>
        <label for="city">Населенный пункт</label><br><input type="text" name="city" id="city">
        <div class="errorForm"><br></div>
        <label for="street">Улица</label><br><input type="text" name="street" id="street">
        <div class="errorForm"><br></div>
        <label for="num_home">Дом №</label><br><input type="text" name="num_home" id="num_home">
        <div class="errorForm"><br></div>

        <label for="letter">Литера</label><br><input type="text" name="letter" id="letter" class="optional">
        <div class="errorForm"><br></div>
        <span class="separator">Информация об инвентаризации</span><br>
        <label for="inv_num">Инвентарный номер</label><br>
        <input type="text" name="inv_num" id="inv_num" class="optional">
        <div class="errorForm"><br></div>
        <label for="kad_num">Кадастровый номер</label><br>
        <input type="text" name="kad_num" id="kad_num" class="optional">
        <div class="errorForm"><br></div>
        <label for="inv_date">Дата технической инвентаризации (ДД.ММ.ГГГГ)</label><br>
        <input type="text" name="inv_date" id="inv_date">
        <div class="errorForm"><br></div>
        <button class="greenButton">Отправить</button>


    </form>
    <div id="successGeneralForm">
        <span id="messageSuccess"></span>
        <a id ="editThis" class="greenButton">Продолжить ввод информации</a>
    </div>
</main>
<script type="text/javascript" src="../includes/js/jQuery.js"></script>
<script type="text/javascript" src="../includes/js/script.js"></script>
<script>
    var input = $("input:not(.optional)");
    var select = $("select");
    var invDate=$("#inv_date");



    reserErrorInput(select);
    reserErrorInput(input);


    var reg = /(0[1-9]|[12][0-9]|3[01])[.](0[1-9]|1[012])[.](19|20)\d\d/;

    function send() {

        var error = false;

        if (select.val() == null) {
            addRedBorder(select);
            select.next().html("Пожалуйста, выберите тип объекта");
            error = true;
        }
        if (!reg.test(invDate.val())) {
            addRedBorder(invDate);
            invDate.next().html("Пожалуйста, введите дату в формате ДД.ММ.ГГГГ");
            error = true;
        }
        var reverseInput = $(input.get().reverse());
        reverseInput.each(function () {
                if (!checkEmpty($(this))) {
                    addRedBorder($(this));
                    addErrorEmpty($(this).next());
                    error = true;
                }
            }
        );


        if (error) {
            alert("Пожалуйста, заполните указанные поля или исправьте ошибки заполнения");

        }
        else {
            var form = $('#formGeneral');
            var msg = form.serialize();
            msg += "&region=" + "<?php echo $idRegion?>" + "&idUser=" + "<?php echo $userInfo['id']?>";
            $.ajax({
                type: 'POST',
                url: '../passportsNew',
                data: msg,
                success: function (data) {

                    $("#formGeneral").hide();
                    $("#editThis").attr("href", "../editPassport/"+data);
                    $("#messageSuccess").html("Создан технический паспорт c регистрационным номером: "+data);
                    $("#successGeneralForm").show();
                }
            });

        }

    }
</script>
<?php
include_once ROOT . '/views/modules/footer.php';
?>
