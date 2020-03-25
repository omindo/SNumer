<h1>Newton-Cotes Integration Formulas</h1>
<!-- <div><a href="https://planetcalc.com/4324/" data-lang="en" data-code=""
        data-colors="#263238,#435863,#090c0d,#fa7014,#fb9b5a,#c25004" data-v="3342"></a>
    <script src="https://embed.planetcalc.com/widget.js?v=3342"></script>
</div> -->

<body onload="draw();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <form>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputSelect">SELECT</label>
                                <select class="form-control" id="inputSelect">
                                    <option value="1">TRAPEZOIDAL</option>
                                    <option value="2">SIMPSON</option>
                                    <option value="3">SIMPSON 3/8</option>
                                    <option value="4">BOOLE</option>
                                    <option value="5">NCOTES</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEqual">INPUT EQUAL</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="1/3*x^3"
                                    value="1/3*x^3" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="xStart">INPUT X START</label>
                                <input type="text" class="form-control" id="xStart" placeholder="0" value="0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="xEnd">INPUT X END</label>
                                <input type="text" class="form-control" id="xEnd" placeholder="1" value="5" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputN">INPUT f(xn) SPLIT</label>
                                <input type="text" class="form-control" id="inputN" placeholder="4" value="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-lg btn-block"
                            onclick=" draw(); Newton_Cotes();">ENTER</button>
                    </div>
                </form>
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
                    <label for="outputTable">OUTPUT</label>
                    <table id="outputTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>result</th>
                                <th>real</th>
                                <th>error</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
const Newton_Cotes = () => {
    var table = document.getElementById("outputTable");
    var expression = document.getElementById("inputEqual").value;
    var xstart = document.getElementById("xStart").value;
    var xend = document.getElementById("xEnd").value;
    var n = document.getElementById("inputSelect").value;
    var ns = document.getElementById("inputN").value;
    n = parseInt(n);
    ns = parseInt(ns);
    xstart = parseFloat(xstart);
    xend = parseFloat(xend);
    var arrayx = [],
        arrayy = [];
    var error = 0;
    var result = 0;
    var currentx = xstart;
    var range = Math.abs((xstart - xend) / ns);
    if (document.getElementById("outputTable").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    for (i = 0; i < ns; i++) {
        arrayx.push(currentx);
        arrayy.push(funcal(currentx, expression));
        if (n == 1) {
            result = result + trapezoidal(currentx, currentx + range, expression);
            currentx = currentx + range;
        } else if (n == 2) {
            result = result + simpson(currentx, currentx + range, expression);
            currentx = currentx + range;
        } else if (n == 3) {
            result = result + simpson38(currentx, currentx + range, expression);
            currentx = currentx + range;
        } else if (n == 4) {
            result = result + boole(currentx, currentx + range, expression);
            currentx = currentx + range;
        } else if (n == 5) {
            result = result + Ncotes(currentx, currentx + range, expression);
            currentx = currentx + range;
        }
    }


    arrayx.push(currentx);
    arrayy.push(funcal(currentx, expression));

    draw(arrayx, arrayy);

    var realarea = infuncal(xstart, xend, expression);
    error = Math.abs(result - realarea);

    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell1.innerHTML = result.toFixed(8);
    cell2.innerHTML = realarea.toFixed(8);
    cell3.innerHTML = error.toFixed(8);

}


const trapezoidal = (a, b, expression) => {
    return ((b - a) / 2) * (funcal(a, expression) + funcal(b, expression));
}

const simpson = (a, b, expression) => {
    temp = (b - a) / 2;
    return ((b - a) / 6) * (funcal(a, expression) + 4 * funcal(a + temp, expression) + funcal(b, expression));
}

const simpson38 = (a, b, expression) => {
    temp = (b - a) / 3;
    return ((b - a) / 8) * (funcal(a, expression) + 3 * funcal(a + temp, expression) + 3 * funcal(a + temp * 2,
        expression) + funcal(b, expression));
}

const boole = (a, b, expression) => {
    temp = (b - a) / 4;
    return ((b - a) / 90) * (7 * funcal(a, expression) + 32 * funcal(a + temp, expression) + 12 * funcal(a + temp *
        2, expression) + 32 * funcal(a + temp * 3, expression) + 7 * funcal(b, expression));
}

const Ncotes = (a, b, expression) => {
    temp = (b - a) / 5;
    return ((b - a) / 288) * (19 * funcal(a, expression) + 75 * funcal(a + temp, expression) + 50 * funcal(a +
        temp * 2, expression) + 50 * funcal(a + temp * 3, expression) + 75 * funcal(a + temp * 4,
        expression) + 19 * funcal(b, expression));
}


// แก้สมาการ X
const funcal = (X, expression) => {
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X)
    };
    return expr.eval(scope);
}

const infuncal = (a, b, expression) => {
    var integral = Algebrite.integral(Algebrite.eval(expression)).toString();
    console.log(integral);
    expr = math.compile(integral);
    let scope_a = {
        x: parseFloat(a)
    };
    let scope_b = {
        x: parseFloat(b)
    };
    return expr.eval(scope_b) - expr.eval(scope_a);
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("outputTable").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("outputTable").deleteRow(1);
    }
}

const draw = (x, y) => {
    try {
        const data = [{
            x: x,
            y: y
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