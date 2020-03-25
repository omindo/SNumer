<h1>Heun's method</h1>

<body onload="Heun();">
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
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="Heun();">ENTER</button>
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
                            <td id="Currentx" style="text-align: center;"></td>
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
const Heun = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("inputEqual").value;
    var xStart = document.getElementById("inputXStart").value;
    var xEnd = document.getElementById("inputXEnd").value;
    var y = document.getElementById("inputY").value;
    var h = document.getElementById("inputH").value;
    var y0 = 0;
    var expressionReal = document.getElementById("inputRealEqual").value;

    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    var error = 0;
    y = parseFloat(y);
    h = parseFloat(h);
    xStart = parseFloat(xStart);
    var currentXStart = xStart;
    var fxReal, check = 0,
        n = 0;
    var arrayX = [],
        arrayY = [],
        arrayRY = [],
        arrayX2 = [];

    arrayX.push(currentXStart);
    arrayY.push(y);
    
    fxReal = funcal(currentXStart, expressionReal);
    arrayX2.push(currentXStart);
    arrayRY.push(fxReal);

    while (currentXStart <= xEnd) {
        n++;

        //  H
        y0 = y + funcalXY(currentXStart, y, expression) * h;
        // ตัวแก้
        // + H เก่า + ใหม่ / 2
        //fx0y0
        //fx1y1
        y = y + ((funcalXY(currentXStart, y, expression) + funcalXY(currentXStart + h, y0, expression)) / 2) * h
        fxReal = funcal(currentXStart + h, expressionReal);
        console.log(currentXStart);
        console.log(y);
        check = Math.abs(y - fxReal);

        arrayX2.push(currentXStart + h);
        arrayX.push(currentXStart + h);
        arrayY.push(y);
        arrayRY.push(fxReal);

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        // Add some text to the new cells:
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell3.setAttribute("id", "cell");
        cell4.setAttribute("id", "cell");
        cell5.setAttribute("id", "cell");

        cell1.innerHTML = currentXStart;
        cell2.innerHTML = y;
        cell3.innerHTML = y0;
        cell4.innerHTML = fxReal;
        cell5.innerHTML = check;


        currentXStart = currentXStart + h;


    }
    draw(arrayX, arrayY, arrayRY, arrayX2);
}
/*const test2 = () => {
		var expression = document.getElementById("inputEqual").value;
		console.log(test(2,3,expression));

	}
*/

//แก้ x และ y
const funcalXY = (X, Y, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X),
        y: parseFloat(Y)
    };
    return expr.eval(scope);
}

// แก้สมาการ X
const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}

//การวาดที่จะไปใส่ใน plot
const draw = (x, y, fxReal, x2) => {
    try {
        /*// compile the expression once
        const expression = document.getElementById('inputEqual').value
        const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        const xValues = math.range(-10, 10, 0.5).toArray()
        const yValues = xValues.map(function (x) {
        	return expr.eval({x: x})
        })

        // render the plot using plotly
        const trace1 = {
        	x: xValues,
        	y: yValues,
        	type: 'scatter'
        }
        const trace2 = {
        	x: xValues,
        	y: yValues,
        	type: 'scatter'
        }*/
        const data = [{
            x: x2,
            y: fxReal,
            name: 'Real'
        }, {
            x: x,
            y: y,
            name: 'Heun'
        }]
        Plotly.newPlot(plot, data, {
            margin: {
                t: 0
            }
        });

        /*const data = [trace1,trace2]
        Plotly.newPlot('plot', data)*/
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>


<!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item"
        src="https://www.wolframcloud.com/objects/demonstrations/EulersMethodForTheExponentialFunction?_width=700&_view=frameless"
        freamborder="0" allowfullscreaen></iframe>
</div> -->