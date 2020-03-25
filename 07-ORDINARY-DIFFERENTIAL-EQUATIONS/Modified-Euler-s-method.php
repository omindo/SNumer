<h1>Modified Euler's method</h1>


<body onload="Modified_Euler();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">input Equal</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="4x-2y/x"
                                    value="4x-2y/x">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputXStart">Start X</label>
                                <input type="text" class="form-control" id="inputXStart" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputXEnd">End X</label>
                                <input type="text" class="form-control" id="inputXEnd" placeholder="2" value="2">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputY">Y(0)</label>
                                <input type="text" class="form-control" id="inputY" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputH">H</label>
                                <input type="text" class="form-control" id="inputH" placeholder="0.25" value="0.25">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputRealEqual">input Real Equal</label>
                                <input type="text" class="form-control" id="inputRealEqual" placeholder="x^2"
                                    value="x^2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="Modified_Euler();">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div id="plot" class="pot1"></div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>output</h5>
                    <table id="output" class="table table-bordered">
                        <tr style="text-align: center;">
                            <th>Currentx</th>
                            <th>Y</th>
                            <th>realY</th>
                            <th>error</th>
                        </tr>
                        <tr class="list-data">
                            <td id="Currentx"></td>
                            <td id="Y"></td>
                            <td id="realY"></td>
                            <td id="error"></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
const Modified_Euler = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("inputEqual").value;
    var xStart = document.getElementById("inputXStart").value;
    var xEnd = document.getElementById("inputXEnd").value;
    var y = document.getElementById("inputY").value;
    var h = document.getElementById("inputH").value;
    var expressionReal = document.getElementById("inputRealEqual").value;

    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    var error = 0;
    y = parseFloat(y);
    h = parseFloat(h);
    xStart = parseFloat(xStart);
    var currentXStart = xStart;
    var yReal, checkErr = 0,
        n = 0,
        ytemp = 0;
    var arrayX = [],
        arrayY = [],
        arrayRY = [],
        arrayRX = [];

    arrayX.push(currentXStart);
    arrayY.push(y);

    yReal = funcal(currentXStart, expressionReal);
    arrayRX.push(currentXStart);
    arrayRY.push(yReal);

    while (currentXStart <= xEnd) {
        n++;
        // Euler * h/2
        ytemp = y + funcalXY(currentXStart, y, expression) * (h / 2);
        // solution ตัวแก้
        y = y + funcalXY(currentXStart + (h / 2), ytemp, expression) * h;
        // 
        yReal = funcal(currentXStart + h, expressionReal);
        // หา Err
        checkErr = Math.abs(y - yReal);
        arrayRX.push(currentXStart + h);
        arrayX.push(currentXStart + h);
        arrayY.push(y);
        arrayRY.push(yReal);

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        // Add some text to the new cells:
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell3.setAttribute("id", "cell");
        cell4.setAttribute("id", "cell");

        cell1.innerHTML = currentXStart;
        cell2.innerHTML = y;
        cell3.innerHTML = yReal;
        cell4.innerHTML = checkErr;

        // ขยับหา xEnd เพิ่มทีละ h
        currentXStart = currentXStart + h;


    }
    draw(arrayX, arrayY, arrayRX, arrayRY);
}

//แก้ x และ y
const funcalXY = (X, Y, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X),
        y: parseFloat(Y)
    };
    return expr.eval(scope);
}

const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}

const draw = (x, y, xReal, yReal) => {
    try {
        const data = [{
            x: xReal,
            y: yReal,
            name: 'Real'
        }, {
            x: x,
            y: y,
            name: 'Euler'
        }]
        Plotly.newPlot(plot, data, {
            margin: {
                t: 0
            }
        });
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>