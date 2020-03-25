<h1>Matrix Inversion Method</h1>

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
            <!-- <div class="card">
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
            <br> -->
            <div class="card">
                <div class="card-body">
                    <h5>output (Inversion Metrix)</h5>
                    <table id="outputInv" class="table table-bordered"></table>
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
        // for (j = 0; j <= n; j++) {
        for (j = 0; j < n; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    var a = [];
    // var b = [];
    for (i = 0; i < n; i++) {
        a.push([]);
        // for (j = 0; j <= n; j++) {
        for (j = 0; j < n; j++) {
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
    // ]
    // console.log(math.inv(a));

    // b = [5, 10, 20]
    // Matrix_Inversion(a, b);
    Matrix_Inversion(a);
}

// const Matrix_Inversion = (a, b) => {
const Matrix_Inversion = (a) => {
    var n = a.length;
    var m = parseInt(n) + 1;
    // var table = document.getElementById("output");
    var table2 = document.getElementById("outputInv");
    if (document.getElementById("outputInv").getElementsByTagName("tr").length > 0) {
        cleantable();
    }

    // หา Matrix Inversion
    var matrixInv = math.inv(a);


    for (i = 0; i < n; i++) {
        var row = table2.insertRow(i);
        for (j = 0; j < n; j++) {
            var cell = row.insertCell(j);
            cell.setAttribute("id", "celloutput");
            cell.innerHTML = matrixInv[i][j];
        }
    }
    // var result = math.multiply(matrixInv, b);
    // var num = 1;
    // for (i = 0; i < n; i++) {
    //     var row = table.insertRow(num);
    //     var cell1 = row.insertCell(0);
    //     var cell2 = row.insertCell(1);
    //     cell1.innerHTML = "X|" + num + ":    ";
    //     cell2.innerHTML = result[i];
    //     num++;
    // }
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("outputInv").getElementsByTagName("tr").length;
    for (j = 0; j < count; j++) {
        document.getElementById("outputInv").deleteRow(0);
    }
    // var count = document.getElementById("output").getElementsByTagName("tr").length;
    // for (j = 1; j < count; j++) {
    //     document.getElementById("output").deleteRow(1);
    // }
}

const CreateTable = (n) => {
    var table = document.getElementById("InputTable");
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }

    var row = table.insertRow(0);
    // for (i = 0; i <= n; i++) {
    for (i = 0; i <= n; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            // if (i == parseInt(n)) {
            //     var cell = row.insertCell(i);
            //     cell.innerHTML = "Y";
            // }
            var cell = row.insertCell(i);
            cell.innerHTML = "X" + parseInt(i - 1);
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        // for (j = 0; j <= parseInt(n) + 1; j++) {
        for (j = 0; j < parseInt(n) + 1; j++) {
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
        <iframe src="https://atozmath.com/matrix.aspx?q=inv" width="760" height="5000px" scrolling="no" frameborder="0"
            allowtransparency="true"></iframe>
    </div>
</div> -->