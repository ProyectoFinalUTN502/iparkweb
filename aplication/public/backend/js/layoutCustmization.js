var dragStart = 0;
var dragEnd = 0;
var isDragging = false;
var circulation = false;
var invalid = false;

function eventClick(e) {
    if (circulation) {
        var maxValue = 0;
        $("#layoutTable td").each(function () {
            var value = $(this).data("circulation-value");

            if (value > maxValue) {
                maxValue = value;
            }

        });
        var newValue = maxValue + 1;
        $(this).data("circulation-value", newValue);
        $(this).data("vt", "0");
        $("#layoutTable").css("cursor", "default");
        criculation = false;
        console.log("Max Circulacion: " + newValue);
    }
    
    if(invalid) {
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).css("background-color", "#909090");
        
        $("#layoutTable").css("cursor", "default");
        invalid = false;
        console.log("Posicion Invalida cargada");
    }
}

function rangeMouseDown(e) {
    if (isRightClick(e)) {
        return false;
    } else {
        var allCells = $("#layoutTable td");
        dragStart = allCells.index($(this));
        isDragging = true;

        if (typeof e.preventDefault != 'undefined') {
            e.preventDefault();
        }
        document.documentElement.onselectstart = function () {
            return false;
        };
    }
}

function rangeMouseUp(e) {
    if (isRightClick(e)) {
        return false;
    } else {
        var allCells = $("#layoutTable td");
        dragEnd = allCells.index($(this));

        isDragging = false;
        if (dragEnd != 0) {
            selectRange();
        }

        document.documentElement.onselectstart = function () {
            return true;
        };
    }
}

function rangeMouseMove(e) {
    if (isDragging) {
        var allCells = $("#layoutTable td");
        dragEnd = allCells.index($(this));
        selectRange();
    }
}

function selectRange() {
    var color = $("#rangeColor").val();
    var vt = $('#vehicleType').val();

    if (color === "" || vt === "") {
        return;
    }

    if (dragEnd + 1 < dragStart) { // reverse select
        $("#layoutTable td").slice(dragEnd, dragStart + 1).css("background-color", color);
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("valid-position", "1");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("vt", vt);
    } else {
        $("#layoutTable td").slice(dragStart, dragEnd + 1).css("background-color", color);
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("valid-position", "1");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("vt", vt);
    }
}

function isRightClick(e) {
    if (e.which) {
        return (e.which == 3);
    } else if (e.button) {
        return (e.button == 2);
    }
    return false;
}

function createTable() {
    var table = "";
    var level   = $("#floor").val();
    var maxRows = $("#maxRows").val();
    var maxCols = $("#maxCols").val();
    
    if(level === "" || maxRows === "" || maxCols === ""){
        var content = "<span class='error'><b>** La inforacion ingresada no es correcta **</b></span>";
        $("#layoutTable").empty();
        $("#errorDiv").html(content);
        return;
    } else {
        $("#errorDiv").empty();
    }
    
    var pos = 1;
    if (maxRows !== "" && maxCols !== "") {
        $("#layoutTable").empty();
        for (var i = 0; i < maxRows; i++) {
            table += "<tr>";
            for (var j = 0; j < maxCols; j++) {
                table += "<td id='" + pos  + "' \n\
                        align='center' \n\
                        data-x='" + i + "' \n\
                        data-y='" + j + "'\n\
                        data-vt='0'\n\
                        data-circulation-value ='0' \n\
                        data-valid-position='1' ></td>";
                pos++;
            }
            table += "</tr>";
        }
    }

    $("#layoutTable").append(table);
    $("#layoutTable td")
            .click(eventClick)
            .mousedown(rangeMouseDown)
            .mouseup(rangeMouseUp)
            .mousemove(rangeMouseMove);
}

function setColor(color, id) {
    $('#rangeColor').val(color);
    $('#vehicleType').val(id);
    $("#layoutTable").css("cursor", "crosshair");
}

function setCirculation() {
    circulation = true;

    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function setInvalid() {
    invalid = true;
    
    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function clean() {
    $('#rangeColor').val("#FFFFFF");
    $('#vehicleType').val("0");
    $("#layoutTable").css("cursor", "pointer");
}

function cleanAll() {
    $("#layoutTable tr").each(function () {
        $('td', this).css('background-color', "");
    });

    $("#rangeColor").val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "default");
    
    circulation = false;
}

function readAll() {
    $("#layoutTable td").each(function () {
        //var id = $(this).attr("id");
        var x = $(this).data("x");
        var y = $(this).data("y");
        var cv = $(this).data("circulation-value"); 
        var valid = $(this).data("valid-position");
        var color = $(this).data("vt");
        
        console.log("( " + x + " , " +  y + ")" + " | " + cv + " | " + color + " | " + valid);
    });
}

//function hexc(colorval) {
//    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
//    delete(parts[0]);
//    for (var i = 1; i <= 3; ++i) {
//        parts[i] = parseInt(parts[i]).toString(16);
//        if (parts[i].length == 1) {
//            parts[i] = '0' + parts[i];
//        }
//        
//    }
//    color = parts.join('');
//
//    return color;
//}

function clearFields() {
    $("#floor").val("");
    $("#maxRows").val("");
    $("#maxCols").val("");
    $("#rangeColor").val("");
    $('#vehicleType').val("");
    $("#layoutTable").empty();
    $("#errorDiv").empty();
}

function generate()
{
    var floor   = $("#floor").val();
    var maxRows = $("#maxRows").val();
    var maxCols = $("#maxCols").val();
    var dataArray = [];
   
    $("#layoutTable td").each(function () {
//        var id = $(this).attr("id");
//        var color = $(this).css("background-color");
        
        var x = $(this).data("x");
        var y = $(this).data("y");
        var valid = $(this).data("valid-position");
        var cv = $(this).data("circulation-value"); 
        var vt = $(this).data("vt"); 
        
        var obj = {};
        obj["x"] = x;
        obj["y"] = y;
        obj["valid"] = valid;
        obj["cv"] = cv;
        obj["vt"] = vt;
        
        dataArray.push(obj);
    });
    
    sendLayout(dataArray, floor, maxRows, maxCols);
    clearFields();
}