<h1>Bisection Method</h1>

<body onload="checkInput();">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEqual">input Equal</label>
                                <input type="text" class="form-control" id="inputEqual" placeholder="e^(-x/4)*(2-x)-1" value="e^(-x/4)*(2-x)-1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputXL">Number Start (XL)</label>
                                <input type="text" class="form-control" id="inputXL" placeholder="0" value="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputXR">Number End (XR)</label>
                                <input type="text" class="form-control" id="inputXR" placeholder="1" value="1">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="inputPassword4">Error</label>
                                <input type="text" class="form-control" id="findErr" placeholder="0.00001"
                                    value="0.00001">
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="checkInput();">ENTER</button>
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
                <div class="card-body">
                    <table id="outputTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Iteration</th>
                                <th scope="col">XL</th>
                                <th scope="col">XR</th>
                                <th scope="col">XM</th>
                                <th scope="col">Error(%)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>



<script>
    const checkInput = () => {
        if (inputXL.value > inputXR.value) {
            window.alert("inputXL < inputXR");
        } else {
            bisection();
        }
    }


    const bisection = () => {

        console.log(document.getElementById('inputEqual').value)
        console.log(document.getElementById('inputXL').value)
        console.log(document.getElementById('inputXR').value)
        var xl = document.getElementById("inputXL").value;
        var xr = document.getElementById("inputXR").value;
        var table = document.getElementById("outputTable");
        var findErr = 0.00001;
        // var findErr = document.getElementById("findErr").value;
        var xmOld = xr;
        var xm = 0;
        var xmOld = 0;
        var n = 0;
        var check = 0.0;
        if (document.getElementById("outputTable").getElementsByTagName("tr").length > 0) {
            cleantable();
        }
        do {

            if (xl != xr) {
                xm = (parseFloat(xl) + parseFloat(xr)) / 2;
                check = Math.abs(xm - xmOld).toFixed(8);
            } else {
                check = 0;
            }

            // console.log(n);

            if (n > 0) {
                var errPer = Math.abs(((xm - xmOld) / xm) * 100).toFixed(8)
                // console.log(errPer);
            }

            n++;
            // Create an empty <tr> element and add it to the 1st position of the table:
            var row = table.insertRow(n);

            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            // Add some text to the new cells:
            console.log(n)
            cell1.innerHTML = n;
            cell1.setAttribute("id", "cell");
            console.log(xl)
            cell2.innerHTML = xl;
            cell2.setAttribute("id", "cell");
            console.log(xr)
            cell3.innerHTML = xr;
            cell3.setAttribute("id", "cell");
            console.log(xm)
            cell4.innerHTML = xm;
            cell4.setAttribute("id", "cell");
            console.log(errPer)
            cell5.innerHTML = errPer;
            cell5.setAttribute("id", "cell");

            //เลือกตัดซ้ายหรือขวาจาก f(xm)
            if (funcal(xm) * funcal(xr) < 0) {
                xl = xm;
            } else {
                xr = xm
            }
            xmOld = xm;
        } while (check > findErr)
        afDraw(xm);
    }

    const funcal = (X) => {
        var expression = document.getElementById("inputEqual").value;
        expr = math.compile(expression);
        let scope = {
            x: parseFloat(X)
        };
        return expr.eval(scope);
    }

    // ลบ table
    const cleantable = () => {
        var count = document.getElementById("outputTable").getElementsByTagName("tr").length;
        for (j = 1; j < count; j++) {
            document.getElementById("outputTable").deleteRow(1);
        }
    }


    const afDraw = (xm) => {

        // compile the expression once
        const expression = document.getElementById('inputEqual').value

        const expr = math.compile(expression)

        // evaluate the expression repeatedly for different values of x
        const xValues = math.range(-10, 10, 0.5).toArray()
        const yValues = xValues.map(function(x) {
            return expr.eval({
                x: x
            })
        })
        draw(xValues, yValues, xm);
    }

    const draw = (xValues, yValues, xm) => {
        try {
            // console.log(xValues + " " + yValues + " " + xm);


            // render the plot using plotly
            const fx = {
                x: xValues,
                y: yValues,
                name: 'F(x)',
                type: 'scatter'
            };
            var trace2 = {
                x: [xm],
                y: [0],
                mode: 'markers',
                type: 'scatter',
                name: 'ROOT',
                text: ['XM'],
                marker: {
                    size: 12
                }
            };
            const data = [fx, trace2]
            Plotly.newPlot('plot', data, {
                responsive: true
            });

        } catch (err) {
            console.error(err)
            alert(err)
        }
    }
</script>