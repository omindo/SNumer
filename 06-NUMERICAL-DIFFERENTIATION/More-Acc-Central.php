<h1>More Acc Central</h1>

<body onload="More_Acc_Central(); draw();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="text1">input Equal</label>
                                <input type="text" class="form-control" id="text1" placeholder="x^3-x-2"
                                    value="x^3-x-2">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text2">input X</label>
                                <input type="text" class="form-control" id="text2" placeholder="1" value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text3">input H</label>
                                <input type="text" class="form-control" id="text3" placeholder="5" value="5">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text4">INPUT ODER DIFFERENTIAL (MAX4)</label>
                                <input type="text" class="form-control" id="text4" placeholder="5" value="5">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="More_Acc_Central(); draw(); ">ENTER</button>
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
                    <h1 class="h2" style="margin-top:10px">output</h1>
                    <table id="output" style="padding: 0px 8px;" class="table table-hover">
                        <tr style="text-align: center;">
                            <th width="20%">result</th>
                            <th width="20%">real</th>
                            <th width="20%">error</th>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
const More_Acc_Central = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("text1").value;
    var x = document.getElementById("text2").value;
    var h = document.getElementById("text3").value;
    var n = document.getElementById("text4").value;
    n = parseInt(n);
    h = parseFloat(h);
    x = parseFloat(x);
    var result = 0;
    var error = 0;
    var realdiff = 0;

    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    if (n == 1) {
        result = (-funcal(x + 2 * h, expression) + 8 * funcal(x + h, expression) - 8 * funcal(x - h, expression) +
            funcal(x - 2 * h, expression));
        result = result / (12 * h)
    } else if (n == 2) {
        result = (-funcal(x + 2 * h, expression) + 16 * funcal(x + h, expression) - 30 * funcal(x, expression) +
            16 * funcal(x - h, expression) - funcal(x - 2 * h, expression));
        result = result / (12 * math.pow(h, 2));
    } else if (n == 3) {
        result = (-funcal(x + 3 * h, expression) + 8 * funcal(x + 2 * h, expression) - 13 * funcal(x + h,
            expression) + 13 * funcal(x - h, expression) - 8 * funcal(x - 2 * h, expression) + funcal(x -
            3 * h, expression));
        result = result / (8 * math.pow(h, 3));
    } else {
        result = (-funcal(x + 3 * h, expression) + 12 * funcal(x + 2 * h, expression) - 39 * funcal(x + h,
            expression) + 56 * funcal(x, expression) - 39 * funcal(x - h, expression) + 12 * funcal(x - 2 *
            h, expression) - funcal(x - 3 * h, expression));
        result = result / (6 * math.pow(h, 4));
    }

    realdiff = difffuncal(x, n, expression);
    error = Math.abs(result - realdiff);

    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell1.innerHTML = result;
    cell2.innerHTML = realdiff;
    cell3.innerHTML = error;

}



// แก้สมาการ X
const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

const difffuncal = (X, n, expression) => {
    var ans = expression;
    for (i = 0; i < n; i++) {
        ans = math.derivative(ans, 'x').toString();
    }
    expr = math.compile(ans);
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
const draw = () => {
    try {
        // compile the expression once
        const expression = document.getElementById('text1').value
        const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        const xValues = math.range(-10, 10, 0.5).toArray()
        const yValues = xValues.map(function(x) {
            return expr.eval({
                x: x
            })
        })

        // render the plot using plotly
        const trace1 = {
            x: xValues,
            y: yValues,
            type: 'scatter'
        }
        const data = [trace1]
        Plotly.newPlot('plot', data, {
            margin: {
                t: 0
            }
        })
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>