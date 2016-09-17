var dragStart = 0;
var dragEnd = 0;
var isDragging = false;

var colorCirculation = "#262626";
var colorInvalid = "#909090";
var colorInput = "#8cff66";
var colorOutput = "#ff4d4d";
var colorRampIn = "#6699ff";
var colorRampOut = "#ff4dff";


var circulation = false;
var invalid = false;
var input = false;
var output = false;
var rampIn = false;
var rampOut = false;

function eventClick(e) {
    if (circulation) {
        var newValue = getNextCirculationValue();
        $(this).css("background-color", colorCirculation);
        
        $(this).data("circulation-value", newValue);
        $(this).data("valid-position", "1");
        $(this).data("vt", "0");
        $(this).data("in", "0");
        $(this).data("out", "0");
        $(this).data("rin", "0");
        $(this).data("rout", "0");
        
        $("#layoutTable").css("cursor", "default");
        criculation = false;
        console.log("Valor de Circulacion: " + newValue);
    }
    
    if (invalid) {
        $(this).css("background-color", colorInvalid);
        
        $(this).data("circulation-value", "0");
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).data("in", "0");
        $(this).data("out", "0");
        $(this).data("rin", "0");
        $(this).data("rout", "0");
        
        $("#layoutTable").css("cursor", "default");
        invalid = false;
        console.log("Posicion Invalida cargada");
    }
    
    if (input) {
        $(this).css("background-color", colorInput);
        
        $(this).data("circulation-value", "0");
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).data("in", "1");
        $(this).data("out", "0");
        $(this).data("rin", "0");
        $(this).data("rout", "0");
        
        $(this).html("<b>&#45;</b>");
        
        input = false;
        $("#layoutTable").css("cursor", "default");
        console.log("Entrada cargada");
    }
    
    if (output) {
        $(this).css("background-color", colorOutput);
        
        $(this).data("circulation-value", "0");
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).data("in", "0");
        $(this).data("out", "1");
        $(this).data("rin", "0");
        $(this).data("rout", "0");
        
        $(this).html("<b>X</b>");
        
        output = false;
        $("#layoutTable").css("cursor", "default");
        console.log("Salida cargada");
    }
    
    if (rampIn) {
        $(this).css("background-color", colorRampIn);
        
        $(this).data("circulation-value", "0");
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).data("in", "0");
        $(this).data("out", "0");
        $(this).data("rin", "1");
        $(this).data("rout", "0");
        
        $(this).html("<b>&#62;</b>");
        
        rampIn = false;
        $("#layoutTable").css("cursor", "default");
        console.log("Salida cargada");
    }
    
    if (rampOut) {
        $(this).css("background-color", colorRampOut);
        
        $(this).data("circulation-value", "0");
        $(this).data("valid-position", "0");
        $(this).data("vt", "0");
        $(this).data("in", "0");
        $(this).data("out", "0");
        $(this).data("rin", "0");
        $(this).data("rout", "1");
        
        $(this).html("<b>&#60;</b>");
        
        rampOut = false;
        $("#layoutTable").css("cursor", "default");
        console.log("Salida cargada");
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
        
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("circulation-value", "0");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("in", "0");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("out", "0");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("rin", "0");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).data("rout", "0");
        $("#layoutTable td").slice(dragEnd, dragStart + 1).html("");
    } else {
        $("#layoutTable td").slice(dragStart, dragEnd + 1).css("background-color", color);
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("valid-position", "1");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("vt", vt);
        
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("circulation-value", "0");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("in", "0");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("out", "0");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("rin", "0");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).data("rout", "0");
        $("#layoutTable td").slice(dragStart, dragEnd + 1).html("");
        
        
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

function getNextCirculationValue() {
    var maxValue = 0;
    $("#layoutTable td").each(function () {
        var value = $(this).data("circulation-value");

        if (value > maxValue) {
            maxValue = value;
        }

    });
    return (maxValue + 1);
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
                        data-in='0'\n\
                        data-out='0'\n\
                        data-rin='0'\n\
                        data-rout='0'\n\
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
    
    invalid = false;
    input = false;
    output = false;
    rampIn = false;
    rampOut = false;

    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function setInvalid() {
    invalid = true;
    
    circulation = false;
    input = false;
    output = false;
    rampIn = false;
    rampOut = false;
    
    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function setInput() {
    input = true;
    
    circulation = false;
    invalid = false;
    output = false;
    rampIn = false;
    rampOut = false;
    
    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function setOutput() {
    output = true;
    
    circulation = false;
    invalid = false;
    input = false;
    rampIn = false;
    rampOut = false;
    
    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function setRampIn() {
    rampIn = true;
    
    output = false;
    circulation = false;
    invalid = false;
    input = false;
    rampOut = false;
    
    $('#rangeColor').val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "crosshair"); 
}

function setRampOut() {
    rampOut = true;
    
    output = false;
    circulation = false;
    invalid = false;
    input = false;
    rampIn = false;
    
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
        $('td', this).data("circulation-value", "0");
        $('td', this).data("valid-position", "0");
        $('td', this).data("vt", "0");
        $('td', this).data("in", "0");
        $('td', this).data("out", "0");
        $('td', this).data("rin", "0");
        $('td', this).data("rout", "0");
        $('td', this).html("");
        
    });

    $("#rangeColor").val("");
    $('#vehicleType').val("");
    $("#layoutTable").css("cursor", "default");
    
    circulation = false;
}

function readAll() {
    $("#layoutTable td").each(function () {
        var x = $(this).data("x");
        var y = $(this).data("y");
        var cv = $(this).data("circulation-value"); 
        var valid = $(this).data("valid-position");
        var vt = $(this).data("vt");
        var input = $(this).data("in");
        var output = $(this).data("out");
        var rampIn = $(this).data("rin");
        var rampOut = $(this).data("rout");
        
        
        console.log("( " + x + " , " +  y + ")" + " | " + cv + " | " + vt + " | " + valid + " | " + input + " | " + output + " | " + rampIn + " | " + rampOut);
    });
}

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
        
        var x = $(this).data("x");
        var y = $(this).data("y");
        var valid = $(this).data("valid-position");
        var cv = $(this).data("circulation-value"); 
        var vt = $(this).data("vt"); 
        var input = $(this).data("in");
        var output = $(this).data("out");
        var rampIn = $(this).data("rin");
        var rampOut = $(this).data("rout");
        
        var obj = {};
        obj["x"] = x;
        obj["y"] = y;
        obj["valid"] = valid;
        obj["cv"] = cv;
        obj["vt"] = vt;
        obj["in"] = input;
        obj["out"] = output;
        obj["rin"] = rampIn;
        obj["rout"] = rampOut;
        
        dataArray.push(obj);
    });
    
    sendLayout(dataArray, floor, maxRows, maxCols);
    clearFields();
}