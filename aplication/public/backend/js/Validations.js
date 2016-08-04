jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value !== param;
}, "Incorrect Value");

$(document).ready(function () {
    $("#frmVt").validate({
        ignore: [],
        rules:
                {
                    name: {required: true, maxlength: 255},
                    color: {required: true}
                },
        messages:
                {
                    name: {required: "Este Campo es obligatorio", maxlength: "La longitud maxima es de 255 caracteres"},
                    color: {required: "Debe elegir un color de referencia"}
                },
        errorPlacement: function (error, element)
        {
            switch (element.attr("name"))
            {
                case "color":
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

$(document).ready(function () {
    $("#frmStep_1").validate({
        rules:
                {
                    user: {
                        required: true, 
                        maxlength: 255,
                        remote: {
                            url: "../../user/remoteDuplicateUser",
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
                            url: "../../user/remoteDuplicateEmail",
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
    $("#frmStep_2").validate({
        ignore: [],
        rules:
                {
                    ssid: {required: true, maxlength: 255},
                    name: {required: true, maxlength: 255},
                    description: {required: true, maxlength: 255},
                    openTime: {required: true},
                    closeTime: {required: true},
                    country: {notEqual: "1"},
                    province: {notEqual: "1"},
                    state: {notEqual: "1"},
                    city: {notEqual: "1"},
                    address: {required: true},
                    lat: {required: true},
                    lng: {required: true}
                },
        messages:
                {
                    ssid: {
                        required: "Este Campo es obligatorio", 
                        maxlength: "La longitud maxima es de 255 caracteres"
                    },
                    name: {
                        required: "Este Campo es obligatorio", 
                        maxlength: "La longitud maxima es de 255 caracteres"
                    },
                    description: {
                        required: "Este Campo es obligatorio",
                        maxlength: "La longitud maxima es de 255 caracteres"
                    },
                    openTime: {required: "Este Campo es obligatorio"},
                    closeTime: {required: "Este Campo es obligatorio"},
                    country: {notEqual: "Debe Seleccionar un Pais"},
                    province: {notEqual: "Debe Seleccionar una Provincia"},
                    state: {notEqual: "Debe Seleccionar un Partido"},
                    city: {notEqual: "Debe Seleccionar una Localidad"},
                    address: {required: "La direccion ingresada no es valida"},
                    lat: {required: "La Latitud del Establecimiento es Invalida"},
                    lng: {required: "La Longitud del Establecimiento es Invalida"}
                }, 
        errorPlacement: function (error, element)
        {
            switch (element.attr("name"))
            {
                case "address":
                    error.appendTo("#errorDiv");
                    break;
                case "lat":
                    error.appendTo("#errorDiv");
                    break;
                case "lng":
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