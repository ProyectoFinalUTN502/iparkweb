function confirm(id){
    $("#modal").fadeTo(200, 1).css('display', 'block');
    $("#cover").fadeTo(200, 0.5).css('display', 'block');
    
    $("#cover,#cancel").click(function (event) {
        $("#modal").fadeOut(200);
        $("#cover").fadeOut(200);
    });
    
    $("#confirm").one( "click" , function (event) {
        removeRegister(id, 'del');
        $("#modal").fadeOut(200);
        $("#cover").fadeOut(200);
    });
}