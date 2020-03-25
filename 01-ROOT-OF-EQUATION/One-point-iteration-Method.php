<body onload="OnePoint();">
    <h1>One-point iteration Method</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">input Equal</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="2-e^(x/4)"
                                    value="2-e^(x/4)" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputX">INITIAL NUMBER (X0)</label>
                                <input type="text" class="form-control" id="inputX" placeholder="1" value="1">
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label for="text3">Number End (XR)</label>
                                <input type="text" class="form-control" id="text3" placeholder="5" value="5">
                            </div> -->
                            <!-- <div class="form-group col-md-4">
                                <label for="inputPassword4">Error</label>
                                <input type="text" class="form-control" id="findErr" placeholder="0.00001"
                                    value="0.00001">
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="OnePoint();">ENTER</button>
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
                                <th scope="col">X OLD</th>
                                <th scope="col">X NEW</th>
                                <th scope="col">Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="list-data">
                                <td id="Iteration"></td>
                                <td id="xOld"></td>
                                <td id="x_new"></td>
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
const OnePoint = () => {
    var table = document.getElementById("output");
    var x = document.getElementById("inputX").value;
    var xOld = 0;
    var n = 0;
    var check = parseFloat(0.000000);
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    do {
        x = funcal(x);

        check = Math.abs((x - xOld) / x).toFixed(8);
        console.log(n);
        console.log(x);

        if (n > 0) {
            var errPer = Math.abs(((x - xOld) / x) * 100).toFixed(8)
            console.log(errPer);
        }
        n++;

        xOld = x;

        // Create an empty <tr> element and add it to the 1st position of the table:
        var row = table.insertRow(n);

        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        // Add some text to the new cells:


        cell1.innerHTML = n;
        cell1.setAttribute("id", "cell");
        cell2.innerHTML = xOld;
        cell2.setAttribute("id", "cell");
        cell3.innerHTML = x;
        cell3.setAttribute("id", "cell");
        cell4.innerHTML = errPer;
        cell4.setAttribute("id", "cell");

    } while (check > 0.00001 && n != 0);
    afDraw(x);
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