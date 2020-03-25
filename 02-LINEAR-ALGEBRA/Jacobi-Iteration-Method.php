<h1>Jacobi Iteration Method</h1>

<body onload="CreateTable(inputN.value);getdata();">
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
                        onclick="CreateTable(inputN.value);getdata();">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5>Table Input</h5>
                    <table id="InputTable"></table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5>output (Result)</h5>
                    <table id="output" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">X</th>
                                <th scope="col">resultX</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>output Iteration</h5>
                    <table id="outputIter" class="table table-bordered"></table>
                </div>
            </div>

        </div>
    </div>
</body>



<script>
const getdata = () => {
    n = document.getElementById("inputN").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= parseInt(n) + 1; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }

    var a = [];
    var b = [];
    var x = [];
    for (i = 0; i < n; i++) {
        a.push([]);
        for (j = 0; j <= parseInt(n) + 1; j++) {
            if (j < parseInt(n)) {
                a[i].push(arr[i][j]);
            } else if (j == n) {
                b.push(arr[i][j]);
            } else {
                x.push(arr[i][j]);
            }
        }
    }
    // a = [
    //     [4, -4, 0],
    //     [-1, 4, -2],
    //     [0, 2, 4]
    // ];
    // b = [400, 400, 400]
    // x[100, 100, 100]
    // a = [
    //     [27, 6, -1],
    //     [6, 15, 2],
    //     [1, 1, 54]
    // ];
    // b = [54, 72, 110]
    // x[0, 0, 0]
    Jacobi_Ireration(a, b, x);
}

const Jacobi_Ireration = (a, b, x) => {
    var n = a.length;

    var table = document.getElementById("output");
    var table2 = document.getElementById("outputIter");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    var xOld = [];
    var tempX = [];
    var check = [];
    var checkErr;
    var Iteration = 1;
    for (i = 0; i < n; i++) {
        tempX.push(0.0);
        check.push(0.0);
        xOld.push(0.0);
    }
    // สร้างหัวตาราง
    var row = table2.insertRow(0);
    for (i = 0; i < (parseInt(n) * 2 + 1); i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "Iteration";
        } else if (i < parseInt(n) + 1) {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "x" + i;
        } else {
            var cell = row.insertCell(i);
            cell.setAttribute("id", "cell");
            cell.innerHTML = "Error(x" + (i - n) + ")";
        }
    }

    do {
        checkErr = false;
        // a = [
        //     [27, 6, -1],
        //     [6, 15, 2],
        //     [1, 1, 54]
        // ];
        // b = [54, 72, 110]
        // x[0, 0, 0]
        for (i = 0; i < n; i++) {
            // x = b
            tempX[i] = b[i];
            for (j = 0; j < n; j++) {
                if (i != j) {
                    // เอา F มาหา x = b - a * x
                    // F = [
                    //     [0, x, x],
                    //     [x, 0, x],
                    //     [x, x, 0]
                    // ]
                    tempX[i] = tempX[i] - a[i][j] * x[j];
                }
            }
            // x / E
            // E = [
            //     [x, 0, 0],
            //     [0, x, 0],
            //     [0, 0, x]
            // ]
            console.log(tempX[i] + " / " + a[i][i]);
            tempX[i] = tempX[i] / a[i][i];
            console.log("= " + tempX[i]);
        }
        xOld = x.slice();
        console.log("x " + x.slice());
        x = tempX.slice();
        console.log("x " + tempX.slice());

        for (i = 0; i < n; i++) {
            check[i] = Math.abs((x[i] - xOld[i]) / x[i]);
            if (check[i] > 0.00001) {
                checkErr = true;
            }
        }
        // if (Iteration == 1) {
        //     checkErr = true;
        // }

        row = table2.insertRow(Iteration);
        for (i = 0; i < parseInt(n) * 2 + 1; i++) {
            if (i == 0) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = Iteration;
            } else if (i < parseInt(n) + 1) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = parseFloat(x[i - 1]).toPrecision(8);
            } else {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = parseFloat(check[i - n - 1]).toPrecision(4);
            }
        }
        Iteration++;

    } while (checkErr && Iteration < 100)

    var num = 1;
    for (i = 0; i < n; i++) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = num;
        cell2.innerHTML = x[i];
        num++;
    }
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
    var count = document.getElementById("outputIter").getElementsByTagName("tr").length;
    for (j = 0; j < count; j++) {
        document.getElementById("outputIter").deleteRow(0);
    }
}

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
        cleantable();
    }

    var row = table.insertRow(0);
    for (i = 0; i <= parseInt(n) + 2; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i == parseInt(n) + 1) {
                var cell = row.insertCell(i);
                cell.innerHTML = "Y";
            } else if (i == parseInt(n) + 2) {
                var cell = row.insertCell(i);
                cell.innerHTML = "initial X";
            } else {
                var cell = row.insertCell(i);
                cell.innerHTML = "X" + parseInt(i - 1);
            }
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= parseInt(n) + 2; j++) {
            if (j == 0) {
                var cell = row.insertCell(j);
                cell.innerHTML = "a" + parseInt(i);
            } else {
                var cell = row.insertCell(j);
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("id", (parseInt(i - 1) + "|" + parseInt(j - 1)));
                x.setAttribute("class", "form-control");
                x.setAttribute("value", math.randomInt(100));
                cell.appendChild(x);
            }
        }
    }

}

const cleantableinput = () => {
    var table = document.getElementById("InputTable");
    table.innerHTML = "";
}
</script>


<!-- <style type="text/css">
#ai-div-advanced_iframe {
    height: 5000px;
    overflow: hidden;
    position: relative;
}

#ai-div-inner-advanced_iframe {
    top: -320px !important;
    left: -200px !important;
    position: absolute;
}
</style>
<div id="ai-div-advanced_iframe">
    <div id="ai-div-inner-advanced_iframe">
        <iframe src="https://atozmath.com/CONM/GaussEli.aspx?q=GJ2" width="760" height="5000px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->