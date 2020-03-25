<h1>Lagrange-Interpolation</h1>

<body onload="draw(); CreateTable(inputN.value);">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h5>input 'n' Create table input</h5>
                    <input type="text" class="form-control" id="inputN" placeholder="3" name="text"
                        placeholder="x^3-x-2" value="3" required>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block"
                        onclick="CreateTable(inputN.value)">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5>Table Input</h5>
                    <table id="InputTableA"></table>
                    <table id="InputTable"></table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h1 class="h2" style="margin-top:10px">output</h1>
                    <table id="outputR" style="padding: 0px 8px;" class="table table-hover">
                        <tr style="text-align: center;">
                            <th width="20%">F(X)</th>
                            <th width="30%">Error</th>
                        </tr>
                        <tr class="list-data">
                            <td width="20%" id="X" style="text-align: center;"></td>
                            <td width="30%" id="resultX"></td>
                        </tr>
                    </table>
                    <table id="output" style="padding: 0px 8px;" class="table table-hover">
                        <tr style="text-align: center;">
                            <th width="20%">L(I)</th>
                            <th width="30%">L</th>
                        </tr>
                        <tr class="list-data">
                            <td width="20%" id="X" style="text-align: center;"></td>
                            <td width="30%" id="resultX"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div id="plot" class="pot1"></div>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
const getdata = () => {
    n = document.getElementById("inputN").value;
    tempx = document.getElementById("inputX").value;
    tempfx = document.getElementById("inputFX").value;

    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j < 2; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    var a = [];
    a.push(tempx);
    a.push(tempfx);

    var x = [];
    var y = [];
    console.log(arr);
    console.log(x);
    for (i = 0; i < n; i++) {
        x.push(arr[i][0]);
    }
    for (i = 0; i < n; i++) {
        y.push(arr[i][1]);
    }
    //call

    draw(x, y);
    Lagrange_Interpolation(x, y, a);

}

const Lagrange_Interpolation = (x, y, a) => {
    var n = x.length;
    var table = document.getElementById("output");
    var table2 = document.getElementById("outputR");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    //console.log(RENewton_Interpolation(x,y,2,0));
    var L = [];
    var temp = 1;
    var temp2 = 1;
    for (i = 0; i < n; i++) {
        temp = 1;
        temp2 = 1;
        for (j = 0; j < n; j++) {
            if (i != j) {
                temp = temp * (x[j] - a[0]);
                temp2 = temp2 * (x[j] - x[i]);
            }
        }
        L.push(temp / temp2);
    }

    var row;
    var cell;
    for (i = 1; i < parseInt(n) + 1; i++) {
        row = table.insertRow(i);
        cell = row.insertCell(0);
        cell.setAttribute("id", "cell");
        cell.innerHTML = "L-" + i;
        cell = row.insertCell(1);
        cell.setAttribute("id", "cell");
        cell.innerHTML = L[parseInt(i) - 1];
    }
    var result = L[0] * y[0];

    for (i = 1; i < n; i++) {
        result = result + L[i] * y[i];
    }
    row = table2.insertRow(1);
    cell = row.insertCell(0);
    cell.setAttribute("id", "cell");
    cell.innerHTML = result;
    var error = Math.abs((a[1] - result) / a[1]);
    cell = row.insertCell(1);
    cell.setAttribute("id", "cell");
    cell.innerHTML = error;

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
    var count = document.getElementById("outputR").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("outputR").deleteRow(1);
    }
}

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    var tableA = document.getElementById("InputTableA");
    console.log(document.getElementById("InputTable").getElementsByTagName("tr").length)
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }

    var row = tableA.insertRow(0);
    var cell = row.insertCell(0);
    cell.innerHTML = "X";
    cell = row.insertCell(1);
    cell.innerHTML = "F(X)";

    row = tableA.insertRow(1);
    cell = row.insertCell(0);
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("id", "inputX");
    x.setAttribute("class", "form-control");
    cell.appendChild(x);

    cell = row.insertCell(1);
    x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("id", "inputFX");
    x.setAttribute("class", "form-control");
    cell.appendChild(x);

    row = tableA.insertRow(2);
    cell = row.insertCell(0);
    cell = row.insertCell(1);
    cell.innerHTML = "&nbsp";

    row = table.insertRow(0);
    console.log(n);
    for (i = 0; i <= 2; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i == parseInt(2)) {
                var cell = row.insertCell(i);
                cell.innerHTML = "F(X)";
            } else {
                var cell = row.insertCell(i);
                cell.innerHTML = "X";
            }
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= 2; j++) {
            if (j == 0) {
                var cell = row.insertCell(j);
                cell.innerHTML = "a" + parseInt(i);
            } else {
                var cell = row.insertCell(j);
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("id", (parseInt(i - 1) + "|" + parseInt(j - 1)));
                x.setAttribute("class", "form-control");
                cell.appendChild(x);
            }
        }
    }

}

const cleantableinput = () => {
    var table = document.getElementById("InputTable");
    table.innerHTML = "";
    var table = document.getElementById("InputTableA");
    table.innerHTML = "";
}

//การวาดที่จะไปใส่ใน plot
const draw = (x, y) => {
    try {
        // compile the expression once
        //const expression = document.getElementById('inputN').value
        //const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        //const xValues = math.range(-10, 10, 0.5).toArray()
        //const yValues = xValues.map(function (x) {
        //	return expr.eval({x: x})
        //})

        // render the plot using plotly
        /*const trace1 = {
        	x: xValues,
        	y: yValues,
        	type: 'scatter'
        }*/

        const data = [{
            a: {
                x: x,
                y: y
            }
        }, {
            b: {
                x: x,
                y: y
            }
        }]
        Plotly.newPlot(plot, data, {
            margin: {
                t: 0
            }
        });

        //const data = [trace1]
        //Plotly.newPlot('plot', data)
    } catch (err) {
        console.error(err)
        alert(err)
    }
}
</script>