/**
 * Created by alexeivolodin on 30.01.17.
 */
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
function reserErrorInput(obj) {
    obj.focusin(function () {
        addGrayBorder($(this));
        $(this).next().html("<br>");
    });
}