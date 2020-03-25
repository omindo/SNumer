<body onload="CreateTable(inputN.value);getdata();">
    <h1>Gauss Elimination</h1>
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <label for="inputN">input 'n' Create table input</label>
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
                    <div>
                        <label for="InputTable">Table Input</label>
                        <table id="InputTable"></table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="getdata()">ENTER</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
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

        </div>
    </div>

</body>


<script>
const getdata = () => {
    n = document.getElementById("inputN").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j <= n; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    // arr = [
    //     [2, 1, -3, -1],
    //     [-1, 3, 2, 12],
    //     [3, 1, -3, 0]
    // ];
    Gauss_Elimination(arr);
}

const Gauss_Elimination = (arr) => {
    var n = arr.length;
    var m = parseInt(n) + 1;
    var table = document.getElementById("output");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    // arr = [
    //     [x, x, x],
    //     [0, x, x],
    //     [0, 0, x]
    // ]
    for (i = 0; i < n - 1; i++) {
        for (j = i; j < n - 1; j++) {
            var temp = arr[i][i];
            // console.log("[" + i + i + "] = " + temp);
            var temp2 = arr[j + 1][i];
            // console.log("[" + (j + 1) + i + "] = " + temp2);
            for (k = i; k < m; k++) {
                // if (isFinite(arr[j][k] / temp * temp2)) {

                // (R2)(ทุกตัว) - (R1) * (arr[0][1] / arr[0][0])
                // console.log(arr[j + 1][k] + " - " + arr[i][k] + " * " + temp2 *
                //     temp);
                // arr[j + 1][k] = arr[j + 1][k] - (arr[i][k] / temp *
                //     temp2);
                arr[j + 1][k] = arr[j + 1][k] - (arr[i][k] * (temp2 / temp));
                // }

                // console.log("[" + (j + 1) + k + "] = " + arr[j + 1][k]);
            }
        }
    }
    // แทนค่าย้อนกลับ
    var result = [];
    for (i = n - 1; i >= 0; i--) {
        // เอา 12 02 01 ไป ลบ y
        for (j = n - 1; j > i; j--) {
            console.log("[" + i + n + "] = " + arr[i][n] + " - " + "[" + i + j + "] = " + arr[i][j]);
            arr[i][n] = arr[i][n] - arr[i][j];
            console.log("[" + i + n + "] = " + arr[i][n]);
        }
        // หาค่า x3 x2 x1
        if (isFinite(arr[i][n] / arr[i][i])) {
            result.push(arr[i][n] / arr[i][i]);
        } else {
            result.push(0);
        }
        // console.log("[2] " + arr[i][n] / arr[i][i]);
        for (j = i - 1; j >= 0; j--) {
            // เอาค่า x3 กลับขึ้นไปคูณ R2
            arr[j][i] = result[parseInt(n) - 1 - parseInt(i)] * arr[j][i];
            // console.log("[3] " + i + " " + j + " " + arr[i][n]);
        }
    }

    //add data table
    var num = 1;
    for (i = n - 1; i >= 0; i--) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell1.innerHTML = num;
        cell2.innerHTML = result[i];
        num++;
    }
}

//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
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


<!-- <div><a href="https://planetcalc.com/3566/" data-lang="en" data-code=""
        data-colors="#263238,#435863,#090c0d,#fa7014,#fb9b5a,#c25004" data-v="3342"></a>
    <script src="https://embed.planetcalc.com/widget.js?v=3342"></script>
</div> -->