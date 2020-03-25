<body onload="Secant();">
    <h1>Secant Method</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">input Equal</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="e^x*sin(x)-1"
                                    value="e^x*sin(x)-1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputX0">INITIAL NUMBER1 (X0)</label>
                                <input type="text" class="form-control" id="inputX0" placeholder="0.5" value="0.5">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputX1">INITIAL NUMBER2 (X1)</label>
                                <input type="text" class="form-control" id="inputX1" placeholder="0.6" value="0.6">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="inputPassword4">Error</label>
                                <input type="text" class="form-control" id="findErr" placeholder="0.00001"
                                    value="0.00001">
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="Secant();">ENTER</button>
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
                <div class="card-body">
                    <table id="output" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Iteration</th>
                                <th scope="col">X</th>
                                <th scope="col">Error(%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="list-data">
                                <td id="Iteration"></td>
                                <td id="x"></td>
                                <td id="error"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>



<script>
const Secant = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("inputEqual").value;
    var x0 = document.getElementById("inputX0").value;
    var x1 = document.getElementById("inputX1").value;
    var xNew = 0;
    var n = 0;
    var check = parseFloat(0.000000);
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    do {

        xNew = x1 - funcal(x1) * ((x1 - x0) / (funcal(x1) - funcal(x0)));
        check = Math.abs((xNew - x1) / xNew).toFixed(8);

        if (n > 0) {
            var errPer = Math.abs(((xNew - x1) / xNew) * 100).toFixed(8)
            console.log(errPer);
        }
        n++;
        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);

        // Add some text to the new cells:
        cell1.innerHTML = n;
        cell1.setAttribute("id", "cell");
        cell2.innerHTML = xNew;
        cell2.setAttribute("id", "cell");
        cell3.innerHTML = errPer;
        cell3.setAttribute("id", "cell");

        x0 = x1;
        x1 = xNew;

    } while (check > 0.00001 && n < 100)
    afDraw(xNew)
}



// แก้สมาการ X
const funcal = (X) => {
    var expression = document.getElementById("inputEqual").value;
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

const afDraw = (xm) => {

    // compile the expression once
    const expression = document.getElementById('inputEqual').value

    const expr = math.compile(expression)

    // evaluate the expression repeatedly for different values of x
    const xValues = math.range(-10, 10, 0.5).toArray()
    const yValues = xValues.map(function(x) {
        return expr.eval({
            x: x
        })
    })
    draw(xValues, yValues, xm);
}

const draw = (xValues, yValues, xm) => {
    try {
        console.log(xValues + " " + yValues + " " + xm);


        // render the plot using plotly
        const fx = {
            x: xValues,
            y: yValues,
            name: 'F(x)',
            type: 'scatter'
        };
        var trace2 = {
            x: [xm],
            y: [0],
            mode: 'markers',
            type: 'scatter',
            name: 'ROOT',
            text: ['XM'],
            marker: {
                size: 12
            }
        };
        const data = [fx, trace2]
        Plotly.newPlot('plot', data, {
            responsive: true
        });

    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>