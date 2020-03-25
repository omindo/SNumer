<h1>Multiple Regression</h1>

<body onload="CreateTable(inputN.value,inputX.value);">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputN">INPUT 'N' CREATE TABLE INPUT</label>
                        <input id="inputN" type="text" class="form-control" placeholder="3" value="3" required>
                    </div>
                    <div class="form-group">
                        <label for="inputX">INPUT 'X' (COUNT X)</label>
                        <input id="inputX" type="text" class="form-control" placeholder="3" value="3" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg btn-blockbtn btn-primary btn-lg btn-block"
                        onclick="CreateTable(inputN.value,inputX.value)">ENTER</button>
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

                    <table id="output" style="padding: 0px 8px;" class="table table-hover">
                        <tr style="text-align: center;">
                            <th width="20%">A(I)</th>
                            <th width="30%">A</th>
                        </tr>
                        <tr class="list-data">
                            <td width="20%" id="X" style="text-align: center;"></td>
                            <td width="30%" id="resultX"></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
const getdata = () => {
    n = document.getElementById("inputN").value;
    m = document.getElementById("inputX").value;
    var arr = [];
    for (i = 0; i < n; i++) {
        arr.push([]);
        for (j = 0; j < parseInt(m) + 1; j++) {
            arr[i].push(document.getElementById(i + "|" + j).value);
        }
    }
    var x = [];
    var y = [];
    for (i = 0; i < n; i++) {
        x.push([]);
        for (j = 0; j < m; j++) {
            x[i].push(arr[i][j]);
        }
    }
    for (i = 0; i < n; i++) {
        y.push(arr[i][m]);
    }
    Multiple_Regression(x, y);
}

const Multiple_Regression = (x, y) => {
    var n = x[0].length + 1;
    var m = x.length;
    var table = document.getElementById("output");
    if (document.getElementById("output").getElementsByTagName("tr").length > 0) {
        cleantable();
    }
    //สร้าง array
    var temp = [];
    var temp2 = [];
    for (i = 0; i < n; i++) {
        temp.push([]);
        for (j = 0; j < n; j++) {
            temp[i].push(parseFloat(0));
        }
    }
    for (i = 0; i < n; i++) {
        temp2.push(parseFloat(0));
    }

    //คำนวนส่วนซ้าย
    for (i = 1; i < n; i++) {
        for (j = i; j < n; j++) {
            for (k = 0; k < m; k++) {
                temp[i][j] = temp[i][j] + (x[k][i - 1] * x[k][j - 1]);
                temp[j][i] = temp[i][j];
            }
        }
    }
    //เตืมขอบ
    for (i = 1; i < n; i++) {
        for (j = 0; j < m; j++) {
            temp[0][i] = temp[0][i] + parseFloat(x[j][i - 1]);
            temp[i][0] = temp[0][i];
        }
    }
    //เติมตัวแรก
    temp[0][0] = m;
    //คำนวนส่วนหลัง
    for (i = 1; i < n; i++) {
        for (j = 0; j < m; j++) {
            temp2[i] = temp2[i] + (x[j][i - 1] * y[j]);
        }
    }
    //เติมที่ขาด
    temp2[0] = math.sum(y);

    var result = math.lusolve(temp, temp2);

    var row;
    var cell;
    for (i = 1; i <= parseInt(n); i++) {
        row = table.insertRow(i);
        cell = row.insertCell(0);
        cell.setAttribute("id", "cell");
        cell.innerHTML = "A-" + (i - 1);
        cell = row.insertCell(1);
        cell.setAttribute("id", "cell");
        cell.innerHTML = parseFloat(result[parseInt(i) - 1]).toPrecision(10);
    }

}


//ลบ table
const cleantable = () => {
    var count = document.getElementById("output").getElementsByTagName("tr").length;
    for (j = 1; j < count; j++) {
        document.getElementById("output").deleteRow(1);
    }
}

const CreateTable = (n, m) => {
    var table = document.getElementById("InputTable");
    console.log(document.getElementById("InputTable").getElementsByTagName("tr").length)
    if (document.getElementById("InputTable").getElementsByTagName("tr").length > 0) {
        cleantableinput();
    }



    row = table.insertRow(0);
    console.log(n);
    for (i = 0; i <= parseInt(m) + 1; i++) {
        if (i == 0) {
            var cell = row.insertCell(i);
            cell.innerHTML = "";
        } else {
            if (i > parseInt(m)) {
                var cell = row.insertCell(i);
                cell.innerHTML = "Y";
            } else {
                var cell = row.insertCell(i);
                cell.innerHTML = "X" + i;
            }
        }
    }
    for (i = 1; i <= n; i++) {
        var row = table.insertRow(i);
        for (j = 0; j <= parseInt(m) + 1; j++) {
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
}

//การวาดที่จะไปใส่ใน plot
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