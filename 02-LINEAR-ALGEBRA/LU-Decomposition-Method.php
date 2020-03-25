<h1>LU Decomposition Method</h1>

<body onload="CreateTable(text1.value);getdata();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h5>input 'n' Create table input</h5>
                    <input type="text" class="form-control" id="text1" placeholder="3" name="text" placeholder="x^3-x-2"
                        value="3" required>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block"
                        onclick="CreateTable(text1.value);getdata();">ENTER</button>
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
                        <tbody>
                            <tr class="list-data">
                                <td id="X"></td>
                                <td id="resultX"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>output (LU)</h5>
                    <table id="outputLU" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">L</th>
                                <th scope="col">U</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="list-dataLU">
                                <td>
                                    <table id="outputL" class="table table-bordered"></table>
                                </td>
                                <td>
                                    <table id="outputU" class="table table-bordered"></table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
const getdata = () => {
    n = document.getElementById("text1").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= n; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    var a = [];
    var b = [];
    for (i = 0; i < n; i++) {
        a.push([]);
        for (j = 0; j <= n; j++) {
            if (j < n) {
                a[i].push(arr[i][j]);
            } else {
                b.push(arr[i][j]);
            }
        }
    }
    // a = [
    //     [2, 3, 4],
    //     [4, 10, 9],
    //     [6, 17, 20]
    // ];
    // b = [23, 59, 101]
    LU_Decomposition(a, b);
}

const LU_Decomposition = (a, b) => {
    var n = a.length;
    var table = document.getElementById("output");
    var tableL = document.getElementById("outputL");
    var tableU = document.getElementById("outputU");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    // const m = [[2, 1], [1, 4]]
    // const r = math.lup(m)
    // r = {
    //   L: [[1, 0], [0.5, 1]],
    //   U: [[2, 1], [0, 3.5]],
    //   P: [0, 1]
    // }
    var LU = math.lup(a);
    // returns column vector with the solution to the linear system A * x = b, lup = math.lup(A)
    var result = math.lusolve(LU, b);

    var num = 1;
    for (i = 0; i < n; i++) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = num;
        cell2.innerHTML = result['_data'][i];
        num++;
    }

    for (i = 0; i < n; i++) {
        var rowL = tableL.insertRow(i);
        var rowU = tableU.insertRow(i);
        for (j = 0; j < n; j++) {
            var cellL = rowL.insertCell(j);
            cellL.setAttribute("id", "cellLU");
            cellL.innerHTML = parseFloat(LU['L'][i][j]).toPrecision(4);
            var cellU = rowU.insertCell(j);
            cellU.setAttribute("id", "cellLU");
            cellU.innerHTML = parseFloat(LU['U'][i][j]).toPrecision(4);
        }
    }
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
    var count2 = document.getElementById("outputL").getElementsByTagName("tr").length;
    for (j = 0; j < count2; j++) {
        document.getElementById("outputL").deleteRow(0);
    }
    var count3 = document.getElementById("outputU").getElementsByTagName("tr").length;
    for (j = 0; j < count3; j++) {
        document.getElementById("outputU").deleteRow(0);
    }
}

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }

    var row = table.insertRow(0);
    for (i = 0; i <= n; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i == parseInt(n)) {
                var cell = row.insertCell(i);
                cell.innerHTML = "Y";
            }
            var cell = row.insertCell(i);
            cell.innerHTML = "X" + parseInt(i - 1);
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= parseInt(n) + 1; j++) {
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



<!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="http://schickling.me/algorithms/#/lu-decomposition" freamborder="0"
        allowfullscreaen></iframe>
</div>

<div id="front"></div> -->
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
        <iframe src="https://atozmath.com/MatrixEv.aspx?q=ludecomp" width="760" height="5000px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->