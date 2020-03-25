<body onload="NewRaphson();">
    <h1>Newton raphson Method</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">INPUT EQUAL</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="sin(x)-x^2"
                                    value="sin(x)-x^2">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputX">INITIAL NUMBER (X)</label>
                                <input type="text" class="form-control" id="inputX" placeholder="1" value="1">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="NewRaphson();">ENTER</button>
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
const NewRaphson = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("inputEqual").value;
    var expressionDiff = math.derivative(expression, 'x');
    console.log(expressionDiff.toString());
    var x = 0;
    var xOld = document.getElementById("inputX").value;
    var n = 0;
    var check = parseFloat(0.00000000);
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    do {

        x = xOld - (funcal(xOld, expression) / funcal(xOld, expressionDiff.toString()));
        check = Math.abs(x - xOld).toFixed(8);
        if (n > 0) {
            var errPer = Math.abs(((x - xOld) / x) * 100).toFixed(8)
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

        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell3.setAttribute("id", "cell");

        cell1.innerHTML = n;
        cell2.innerHTML = x;
        cell3.innerHTML = errPer;

        xOld = x;
    } while (check > 0.00001 && n < 100);
    afDraw(x);
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