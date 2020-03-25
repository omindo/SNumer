<h1>Cholesky Decomposition Method</h1>

<body onload="CreateTable(inputN.value);getdata();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <label for="inputN">INPUT 'N' CREATE TABLE INPUT</label>
                    <input type="text" class="form-control" id="inputN" placeholder="3" value="3" required>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block"
                        onclick="CreateTable(inputN.value);getdata()">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <label for="InputTable">TABLE INPUT</label>
                    <table id="InputTable"></table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <label for="output">OUTPUT (RESULT)</label>
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
                <div class="card-body">
                    <label for="outputL">OUTPUT (L)</label>
                    <table id="outputL" class="table table-bordered"></table>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
// สร้างตาราง
const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    //ล้างตาราง
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




// รับค่าจากตาราง
const getdata = () => {
    n = document.getElementById("inputN").value;
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
    //     [4, -4, 0],
    //     [-1, 4, -2],
    //     [0, -2, 4]
    // ];
    // b = [400, 400, 400]

    // a = [
    //     [2, 3, 4],
    //     [4, 10, 9],
    //     [6, 17, 20]
    // ];
    // b = [23, 59, 101]
    Cholesky_Decomposition(a, b);
}

const Cholesky_Decomposition = (a, b) => {
    var n = a.length;
    var table = document.getElementById("output");
    var tableL = document.getElementById("outputL");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    // Calculate the Matrix LU decomposition with partial pivoting. 
    // Matrix A is decomposed in two matrices (L, U) and
    // a row permutation vector p where A[p,:] = L * U
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
        for (j = 0; j < n; j++) {
            var cellL = rowL.insertCell(j);
            cellL.setAttribute("id", "cellLU");
            cellL.innerHTML = parseFloat(LU['L'][i][j]).toPrecision(8);
        }
    }
}


// ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
    var count2 = document.getElementById("outputL").getElementsByTagName("tr").length;
    for (j = 0; j < count2; j++) {
        document.getElementById("outputL").deleteRow(0);
    }
}

const cleantableinput = () => {
    var table = document.getElementById("InputTable");
    table.innerHTML = "";
}
</script>


<!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="http://schickling.me/algorithms/#/cholesky-decomposition" freamborder="0"
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
        <iframe src="https://atozmath.com/MatrixEv.aspx?q=choleskydecomp" width="760" height="5000px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->