<h1>First Forward</h1>

<body onload="First_Forward();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">input Equal</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="e^(2*x)"
                                    value="e^(2*x)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputX">input X</label>
                                <input type="text" class="form-control" id="inputX" placeholder="2" value="2">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputH">input H</label>
                                <input type="text" class="form-control" id="inputH" placeholder="0.25" value="0.25">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputDiff">input oder Differential</label>
                                <input type="text" class="form-control" id="inputDiff" placeholder="2" value="2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="First_Forward();">ENTER</button>
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
                    <table id="output" style="padding: 0px 8px;" class="table table-bordered">
                        <thead>
                            <th>result</th>
                            <th>real</th>
                            <th>error</th>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
const First_Forward = () => {
    var table = document.getElementById("output");
    var expression = document.getElementById("inputEqual").value;
    var x = document.getElementById("inputX").value;
    var h = document.getElementById("inputH").value;
    var n = document.getElementById("inputDiff").value;
    n = parseInt(n);
    h = parseFloat(h);
    x = parseFloat(x);
    var pascals = pascalsTriangle(n + 1);
    var result = 0;
    var error = 0;
    var realdiff = 0;
    var resultY = [];
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    for (i = 0; i < n + 1; i++) {
        // console.log(result);
        //                  -,+,-               4,6,4           x-i*h (เพื่มทีละ h)
        result = result + math.pow(-1, i) * pascals[n][i] * funcal(x + (n - 1 - i) * h, expression);
        if (i > 0) {
            resultTemp = result;
            resultTemp = resultTemp / math.pow(h, n);
            resultY[i] = resultTemp;
            resultY[i - 2] = result + math.pow(-1, i) * pascals[n][i] * funcal(x + (n - 1 - i) * h, expression);
        }
    }
    console.log(resultY);

    result = result / math.pow(h, n);
    resultY.push(result);
    realdiff = difffuncal(x, n, expression);
    // error = Math.abs(result - realdiff);
    // for (i = 0; i < n; i++) {
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell2.setAttribute("id", "cell");
    cell1.innerHTML = result;
    cell2.innerHTML = realdiff;
    cell3.innerHTML = Math.abs(result - realdiff);
    // }
    afterDraw();
}
const afterDraw = () => {
    var n = parseFloat(document.getElementById("inputX").value);
    var h = parseFloat(document.getElementById("inputH").value);
    var sum1 = [],
        Real1 = []
    var i = new Array();
    for (var i = 1; i <= n; i++) {
        sum1[i - 1] = (f(i + h) - f(i)) / h;
        Real1[i - 1] = funcDiff1(i);
    }
    draw(sum1, Real1);
    // console.log(sum1);
    // console.log(Real1);
}

function f(X) {
    var expression = document.getElementById("inputEqual").value;
    expr = math.compile(expression);
    let scope = {
        x: parseFloat(X),
        y: parseFloat(X),
        z: parseFloat(X)
    };
    var sum = expr.eval(scope);
    return sum;
}


function funcDiff1(X, Y) {
    var test = math.derivative(document.getElementById("inputEqual").value, 'x');
    //console.log(test.toString());
    expr = math.compile(test.toString());
    let scope = {
        x: parseFloat(X),
        y: parseFloat(Y)
    };
    var sum = expr.eval(scope);
    return sum;
}




//สร้าง Pascal's Triangle
const pascalsTriangle = (num) => {
    var pascal = [];
    //Each for() loop here sets up one array, and they are then combined into a new, 2D Array.
    for (var c = 0; c < num; c++) {
        pascal[c] = new Array(c + 1);
        for (var d = 0; d < c + 1; d++) {
            if (d === 0 || d === c) {
                //This function handles a special case scenario in which the border numbers of the triangle will always equal 1.
                pascal[c][d] = 1;
            } else {
                //This mathematical function allows the adjacent values above a coordinate to be added together.
                pascal[c][d] = pascal[c - 1][d - 1] + pascal[c - 1][d];
            }
        }
    }
    return pascal;
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
const draw = (sum1, Real1) => {
    try {
        const Fxdiff1 = {
            x: math.range(-10, 10, 0.5).toArray(),
            y: sum1,
            type: 'scatter'
        }

        const RealFx1 = {
            x: math.range(-10, 10, 0.5).toArray(),
            y: Real1,
            type: 'scatter'
        }
        const data = [Fxdiff1, RealFx1]
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