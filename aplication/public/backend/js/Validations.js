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

$(document).ready(function () {
    $("#frmUsr").validate({
        rules:
                {
                    user: {
                        required: true, 
                        maxlength: 255,
                        remote: {
                            url: "remoteDuplicateUser",
                            type: "post"
                        }
                    },
                    password: {required: true, minlength: 6},
                    repassword: {equalTo: "#password" ,minlength: 6},
                    name: {required: true, maxlength: 255},
                    lastName: {required: true, maxlength: 255},
                    email: {
                        required: true, 
                        email: true, 
                        maxlength: 255,
                        remote: {
                            url: "remoteDuplicateEmail",
                            type: "post"
                        }
                    }
                },
        messages:
                {
                    user: {
                        required: "Este Campo es obligatorio", 
                        maxlength: "La longitud maxima es de 255 caracteres", 
                        remote: "El nombre de usuario elegido ya esta en uso en el sistema"
                    },
                    password: {
                        required: "Este Campo es obligatorio", 
                        minlength: "La longitud minima debe ser de 6 caracteres"
                    },
                    repassword: {
                        equalTo: "Las contraseñas ingresadas deben ser identicas", 
                        minlength: "La longitud minima debe ser de 6 caracteres"
                    },
                    name: {
                        required: "Este Campo es obligatorio", 
                        maxlength: "La longitud maxima es de 255 caracteres"
                    },
                    lastName: {
                        required: "Este Campo es obligatorio", 
                        maxlength: "La longitud maxima es de 255 caracteres"
                    },
                    email: {
                        required: "Este Campo es obligatorio", 
                        email: "El formato de Email ingresado no es valido", 
                        maxlength: "La longitud maxima es de 255 caracteres", 
                        remote: "El email elegido ya esta en uso en el sistema"
                    }
                },
        errorElement: "div"
    });
});



$(document).ready(function () {
    $("#frmUsrPassword").validate({
        rules:
                {
                    password: {required: true, minlength: 6},
                    repassword: {equalTo: "#password" ,minlength: 6}
                },
        messages:
                {
                    password: {
                        required: "Este Campo es obligatorio", 
                        minlength: "La longitud minima debe ser de 6 caracteres"
                    },
                    repassword: {
                        equalTo: "Las contraseñas ingresadas deben ser identicas", 
                        minlength: "La longitud minima debe ser de 6 caracteres"
                    }
                },
        errorElement: "div"
    });
});