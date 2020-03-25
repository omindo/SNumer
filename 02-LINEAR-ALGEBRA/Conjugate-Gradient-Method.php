<h1>Conjugate Gradient Method</h1>

<body onload="createTable(inputN.value);getdata();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <label for="inputN">INPUT 'N' CREATE TABLE INPUT</label>
                    <input type="text" class="form-control" id="inputN" placeholder="3" value="3" required>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block" onclick="createTable(inputN.value);getdata();">ENTER</button>
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
                <div class="card-header">
                    <label for="outputIter">OUTPUT ITERATION</label>
                    <table id="outputIter" class="table table-bordered"></table>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
    // รับค่าจาก inputTable
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
        // b = [400, -950, 200]
        // x = [100, 100, 100]
        Conjugate_Gradient(a, b, x);
    }

    const Conjugate_Gradient = (a, b, x) => {
        var n = a.length;
        var m = parseInt(n) + 1;
        var table = document.getElementById("output");
        var table2 = document.getElementById("outputIter");
        if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
            cleantable();
        }

        var r = math.subtract(math.multiply(a, x), b);
        var d = math.multiply(-1, r);

        var ramda;
        var alpha;
        var check = 0.0;
        var row = table2.insertRow(0);
        for (i = 0; i <= parseInt(n) + 1; i++) {
            if (i == 0) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = "Iteration";
            } else if (i == parseInt(n) + 1) {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = "Error";
            } else {
                var cell = row.insertCell(i);
                cell.setAttribute("id", "cell");
                cell.innerHTML = "x" + i;
            }
        }
        var Iteration = 1;
        do {
            ramda = math.multiply(-1, math.divide(
                math.multiply(math.transpose(d), r),
                math.multiply(math.multiply(math.transpose(d), a), d)));
            x = math.add(math.multiply(ramda, d), x);
            r = math.subtract(math.multiply(a, x), b);
            check = math.sqrt(math.multiply(math.transpose(r), r)).toFixed(8);

            var temp1 = check;
            var temp2 = x;
            row = table2.insertRow(Iteration);
            for (i = 0; i <= parseInt(n) + 1; i++) {
                if (i == 0) {
                    var cell = row.insertCell(i);
                    cell.setAttribute("id", "cell");
                    cell.innerHTML = Iteration;
                } else if (i == parseInt(n) + 1) {
                    var cell = row.insertCell(i);
                    cell.setAttribute("id", "cell");
                    cell.innerHTML = parseFloat(temp1).toPrecision(8);
                } else {
                    var cell = row.insertCell(i);
                    cell.setAttribute("id", "cell");
                    cell.innerHTML = parseFloat(temp2[i - 1]).toPrecision(8);
                }
            }
            Iteration++;

            alpha = math.divide(
                math.multiply(math.multiply(math.transpose(r), a), d),
                math.multiply(math.multiply(math.transpose(d), a), d));
            d = math.subtract(math.multiply(alpha, d), r);
        } while (check > 0.00001 && Iteration < 100)
        var num = 1;
        for (i = 0; i < n; i++) {
            var row = table.insertRow(num);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = "X|" + num + ":    ";
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

    const cleantableinput = () => {
        var table = document.getElementById("InputTable");
        table.innerHTML = "";
    }


    // สร้างตาราง Input
    const createTable = (n) => {
        var table = document.getElementById("InputTable");
        //ล้างตาราง Input
        if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
            cleantableinput();
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
</script>


<!-- <style type="text/css">
#ai-div-advanced_iframe {
    height: 1300px;
    overflow: hidden;
    position: relative;
}

#ai-div-inner-advanced_iframe {
    top: -210px !important;
    position: absolute;
}
</style>
<div id="ai-div-advanced_iframe">
    <div id="ai-div-inner-advanced_iframe">
        <iframe src="https://keisan.casio.com/exec/system/15052019699070" width="760px" height="1500px" scrolling="no"
            frameborder="0" allowtransparency="true"></iframe>
    </div>
</div> -->