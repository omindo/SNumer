<h1>Cramer's Rule</h1>
<!-- <div><a href="https://planetcalc.com/5999/" data-lang="en" data-code=""
        data-colors="#263238,#435863,#090c0d,#fa7014,#fb9b5a,#c25004" data-v="3342"></a>
    <script src="https://embed.planetcalc.com/widget.js?v=3342"></script>
</div> -->

<body onload="CreateTable(inputN.value);getdata();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <label for="inputN">input 'n' Create table input</label>
                    <input type="text" class="form-control" id="inputN" placeholder="3" value="3" required>
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
            <br>
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
    //     [1, 1, 7, 9],
    //     [2, 7, -7, -17],
    //     [3, 6, -5, 0]
    // ];
    // console.log(arr);
    cramerRule(arr);
}

const cramerRule = (arr) => {
    var n = document.getElementById("inputN").value;
    var det = math.resize(arr, [parseInt(n), parseInt(n)]);
    var detCal = math.det(det)
    //แยก y
    var y = math.flatten(math.column(arr, parseInt(n)));
    var detNCal = [];
    for (var i = 0; i < n; i++) {
        var detN = math.resize(arr, [parseInt(n), parseInt(n)]);
        for (var j = 0; j < n; j++) {
            detN[parseInt(j)][i] = y[parseInt(j)];
        }
        detNCal.push(math.det(detN) / detCal);
    }
    console.log(detNCal);
    //add data table
    var table = document.getElementById("output");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    var num = 1;
    for (i = 0; i < n; i++) {
        var row = table.insertRow(num);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.setAttribute("id", "cell");
        cell2.setAttribute("id", "cell");
        cell1.innerHTML = i;
        cell2.innerHTML = detNCal[i];
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