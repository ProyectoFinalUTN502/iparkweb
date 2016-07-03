$(document).ready(function () {
    $("#frmVt").validate({
        rules:
                {
                    name: {required: true, maxlength: 255}
                },
        messages:
                {
                    name: {required: "Este Campo es obligatorio", maxlength: "La longitud maxima es de 255 caracteres"}
                },
        errorElement: "div"
    });
});


