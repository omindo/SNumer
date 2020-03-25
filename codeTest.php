</body>

<script>
$(document).ready(function() {

    $("#bt").click(function() {

        function f(X) {
            var expression = document.getElementById("func").value;
            expr = math.compile(expression);
            let scope = {
                x: parseFloat(X),
                y: parseFloat(X),
                z: parseFloat(X)
            };
            var sum = expr.eval(scope);
            return sum;
        }

        function funcDiff1(X, Y) {

            var test = math.derivative(document.getElementById("func").value, 'x');
            //console.log(test.toString());


            expr = math.compile(test.toString());
            let scope = {
                x: parseFloat(X),
                y: parseFloat(Y)
            };


            var sum = expr.eval(scope);
            return sum;

        }

        function funcDiff2(X, Y) {

            var test = math.derivative(math.derivative(document.getElementById("func").value, 'x'),
                'x');
            //console.log(test.toString());


            expr = math.compile(test.toString());
            let scope = {
                x: parseFloat(X),
                y: parseFloat(Y)
            };


            var sum = expr.eval(scope);
            return sum;

        }

        function funcDiff3(X, Y) {

            var test = math.derivative(math.derivative(math.derivative(document.getElementById("func")
                .value, 'x'), 'x'), 'x');
            expr = math.compile(test.toString());
            let scope = {
                x: parseFloat(X),
                y: parseFloat(Y)
            };


            var sum = expr.eval(scope);
            return sum;

        }

        function funcDiff4(X, Y) {

            var test = math.derivative(math.derivative(math.derivative(math.derivative(document
                .getElementById("func").value, 'x'), 'x'), 'x'), 'x');
            //console.log(test.toString());


            expr = math.compile(test.toString());
            let scope = {
                x: parseFloat(X),
                y: parseFloat(Y)
            };


            var sum = expr.eval(scope);
            return sum;

        }

        var n, h, sum1 = [],
            Real1 = [],
            sum2 = [],
            Real2 = [],
            sum3 = [],
            Real3 = [],
            sum4 = [],
            Real4 = [];
        var x = new Array();
        n = parseFloat($("#x").val());
        h = parseFloat($("#h").val());


        for (var x = 1; x <= n; x++) {
            sum1[x - 1] = (f(x + h) - f(x)) / h;
            sum2[x - 1] = ((f(x + (2 * h)) - (2 * f(x + h)) + f(x))) / (Math.pow(h, 2));
            sum3[x - 1] = ((f(x + (3 * h)) - (3 * f(x + 2 * h)) + (3 * f(x + h)) - f(x))) / (Math.pow(h,
                3));
            sum4[x - 1] = ((f(x + (4 * h)) - (4 * f(x + 3 * h)) + (6 * f(x + 2 * h)) - (4 * f(x + h)) +
                f(x))) / (Math.pow(h, 4));

            Real1[x - 1] = funcDiff1(x);
            Real2[x - 1] = funcDiff2(x);
            Real3[x - 1] = funcDiff3(x);
            Real4[x - 1] = funcDiff4(x);
            console.log(Real1[0]);



            $("#xi").append(x + '<br>');
            $("#ans").append(sum1[x - 1] + '<br>');
            $("#ans2").append(sum2[x - 1] + '<br>');
            $("#ans3").append(sum3[x - 1] + '<br>');
            $("#ans4").append(sum4[x - 1] + '<br>');



        }


        function draw() {
            try {
                // compile the expression once

                // evaluate the expression repeatedly for different values of x


                const Fxdiff1 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: sum1,
                    type: 'scatter'
                }

                const Fxdiff2 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: sum2,
                    type: 'scatter'
                }

                const Fxdiff3 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: sum3,
                    type: 'scatter'
                }

                const Fxdiff4 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: sum4,
                    type: 'scatter'
                }


                const RealFx1 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: Real1,
                    type: 'scatter'
                }

                const RealFx2 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: Real2,
                    type: 'scatter'
                }

                const RealFx3 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: Real3,
                    type: 'scatter'
                }

                // render the plot using plotly
                const RealFx4 = {
                    x: math.range(0, 100, 0.5).toArray(),
                    y: Real4,
                    type: 'scatter'
                }



                const data = [Fxdiff1, RealFx1]
                Plotly.newPlot('plot', data)
            } catch (err) {
                alert(err)
            }
        }

        document.getElementById('form').onsubmit = function(event) {
            event.preventDefault()
            draw()
        }

        draw()

    });
});
</script>