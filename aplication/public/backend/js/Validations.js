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


$(document).ready(function () {
    $("#frmRol").validate({
        ignore: [],
        rules:
                {
                    name: {required: true, maxlength: 255},
                    "groups[]": {required: true}
                },
        messages:
                {
                    name: {required: "Este Campo es obligatorio", maxlength: "La longitud maxima es de 255 caracteres"},
                    "groups[]": {required: "Debe seleccionar al menos un Permiso"}
                },
        errorPlacement: function (error, element)
        {
            switch (element.attr("name"))
            {
                case "groups[]":
                    error.appendTo("#errorDiv");
                    break;
                default:
                    error.insertAfter(element);
                    break;
            }
        },
        errorElement: "div"
    });
});