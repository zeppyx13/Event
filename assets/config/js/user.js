$(document).ready(function () {
    $("#keyword").on("keyup", function () {
        $("#container").load("../config/php/search/user.php?keyword=" + $("#keyword").val() + "&iduser=" + $("#iduser").val());
    });
});