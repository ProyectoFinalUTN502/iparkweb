var dragStart = 0;
var dragEnd = 0;
var isDragging = false;
var circulation = false;

function circulationClick(e) {
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
        $("#layoutTable").css("cursor", "default");
        criculation = false;
        console.log("Max Circulacion: " + newValue);
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

    if (color === "") {
        return;
    }

    if (dragEnd + 1 < dragStart) { // reverse select
        $("#layoutTable td").slice(dragEnd, dragStart + 1).css("background-color", color);
    } else {
        $("#layoutTable td").slice(dragStart, dragEnd + 1).css("background-color", color);
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
                table += "<td id='" + (i + "-" + j)  + "' align='center' data-circulation-value ='0' ></td>";
                pos++;
            }
            table += "</tr>";
        }
    }

    $("#layoutTable").append(table);
    $("#layoutTable td")
            .click(circulationClick)
            .mousedown(rangeMouseDown)
            .mouseup(rangeMouseUp)
            .mousemove(rangeMouseMove);
}

function setColor(color) {
    $('#rangeColor').val(color);
    $("#layoutTable").css("cursor", "crosshair");
}

function setCirculation() {
    circulation = true;

    $('#rangeColor').val("");
    $("#layoutTable").css("cursor", "crosshair");
}

function clean() {
    $('#rangeColor').val("#FFFFFF");
    $("#layoutTable").css("cursor", "pointer");
}

function cleanAll() {
    $("#layoutTable tr").each(function () {
        $('td', this).css('background-color', "");
    });

    $("#rangeColor").val("");
    $("#layoutTable").css("cursor", "default");
    
    circulation = false;
}

//function readAll() {
//    $("#layoutTable td").each(function () {
//        var id = $(this).attr("id");
//        var cv = $(this).data("circulation-value"); 
//        var color = $(this).css("background-color");
//        
//        console.log(id + " |" + cv + " | " + color);
//    });
//}

function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) {
            parts[i] = '0' + parts[i];
        }
        
    }
    color = parts.join('');

    return color;
}

function clearFields() {
    $("#floor").val("");
    $("#maxRows").val("");
    $("#maxCols").val("");
    $("#rangeColor").val("");
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
        var id = $(this).attr("id");
        var cv = $(this).data("circulation-value"); 
        var color = $(this).css("background-color");
        
        var obj = {};
        obj["id"] = id;
        obj["cv"] = cv;
        obj["color"] = hexc(color);
        
        dataArray.push(obj);
    });
    
    sendLayout(dataArray, floor, maxRows, maxCols);
    clearFields();
}