<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 24.02.17
 * Time: 17:26
 */

include_once ROOT . '/views/modules/header.php';
include_once ROOT . '/views/modules/userInfo.php';

?>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" id="buttonBack" class="grayButton">&#8592 Назад</a>
<h3>Общие сведения</h3>
<main>
    <form id="formCharacter" method="POST" action="javascript:void(null);" onsubmit="send()">
        <label for="use">Назначение</label><br>
        <select name="use" id="use">
            <option disabled selected>Выберите назначение объекта</option>
            <?php foreach ($uses AS $use): ?>
                <option value="<?php echo $use['id'] ?>"><?php echo $use['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="errorForm"><br></div>


        <label for="factUse">Фактическое использование</label><br>
        <select name="factUse" id="factUse">
            <option disabled selected>Выберите вид использования</option>
            <option value="0">По назначению</option>
            <option value="1">Не по назначению</option>
        </select> <div class="errorForm"><br></div>


        <label for="year">Год постройки</label><br><input type="text" id="year" name="year">
        <div class="errorForm"><br></div>
        <label for="mainSq">Общая площадь</label><br><input type="text" name="mainSq" id="mainSq">
        <div class="errorForm"><br></div>
        <label for="lifeSq">Жилая площадь</label><br><input type="text" name="lifeSq" id="lifeSq">
        <div class="errorForm"><br></div>
        <label for="floorUp">Число этажей наземной части</label><br><input type="text" name="floorUp" id="floorUp">
        <div class="errorForm"><br></div>
        <label for="floorDown">Число этажей подземной части</label><br><input type="text" name="floorDown"
                                                                              id="floorDown">
        <div class="errorForm"><br></div>
        <button class="greenButton">Отправить</button>


    </form>
    <div id="successCharacterForm">
        <span id="editSuccess">Изменения сохранены!</span>
    </div>
</main>
<script type="text/javascript" src="../includes/js/jQuery.js"></script>
<script type="text/javascript" src="../includes/js/script.js"></script>
<script>
    var input = $("input");


    reserErrorInput(input);



    function send() {

        var error = false;
        var inputs = $(input.get().reverse());
        inputs.each(function () {
                if (isNaN($(this).val())) {
                    error = true;
                    addRedBorder($(this));
                    $(this).next().html("Пожалуйста, введите число");

                }
            }
        );

        if (error) {
            alert("Пожалуйста, исправьте ошибки заполнения");
        }
        else {
            var form = $('#formCharacter');
            var msg = form.serialize();
            msg += "&idUser=" + "<?php echo $userInfo['id']?>";
            alert("JR!");
            /*$.ajax({
                type: 'POST',
                url: '../passportsEditGeneralSave/<?php echo $id ?>',
                data: msg,
                success: function (data) {
                    alert(data);
                    /!*$("#formCharacter").hide();
                     $("#successGeneralForm").show();*!/
                }
            });
*/
        }

    }
</script>
<?php
include_once ROOT . '/views/modules/footer.php';
?>
