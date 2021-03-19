/*$(document).ready(function() {
    $("#password").keyup(function() {
        validateInput();
    });
});

function validateInput() {
    if ($("#password").val().length === 0) $("#verifyPassword").addClass("disab");
    if ($("#password").val().length > 0) $("#verifyPassword").removeClass("disab");
}*/
/*$(document).ready(function() {
    $('#verifyPassword').attr("disabled", true);

    $('#password').keyup(function() {
        var value = $(this).val();
        if (value.length == 0) {
            $('#verifyPassword').attr("disabled", true);
        } else
            $('#cadena').removeAttr("disabled");
    });
});*/
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}