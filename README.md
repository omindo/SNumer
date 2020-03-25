# SNumer

```Docker
docker run -dit --name SiwatNumer -p 80:80 -v "${pwd}:/var/www/html/" php:7.4.3-apache
```

### Function compile
Parse and compile an expression. Returns a an object with a function eval([scope]) to evaluate the compiled expression.

Syntax
math.compile(expr) // returns one node
math.compile([expr1, expr2, expr3, ...]) // returns an array with nodes

Examples
const code1 = math.compile('sqrt(3^2 + 4^2)')
code1.eval() // 5
https://mathjs.org/docs/reference/functions/compile.html

### Function lup
Calculate the Matrix LU decomposition with partial pivoting. Matrix A is decomposed in two matrices (L, U) and a row permutation vector p where A[p,:] = L \* U

Syntax
math.lup(A)
https://mathjs.org/docs/reference/functions/lup.html

### Function multiply
Multiply two or more values, x \* y. For matrices, the matrix product is calculated.

Syntax
math.multiply(x, y)
https://mathjs.org/docs/reference/functions/multiply.html

### Function lusolve
Solves the linear system A \* x = b where A is an [n x n] matrix and b is a [n] column vector.

Syntax
math.lusolve(A, b) // returns column vector with the solution to the linear system A _ x = b
math.lusolve(lup, b) // returns column vector with the solution to the linear system A _ x = b, lup = math.lup(A)
https://mathjs.org/docs/reference/functions/lusolve.html

### Function transpose
Transpose a matrix. All values of the matrix are reflected over its main diagonal. Only applicable to two dimensional matrices containing a vector (i.e. having size [1,n] or [n,1]). One dimensional vectors and scalars return the input unchanged.

Syntax
math.transpose(x)
https://mathjs.org/docs/reference/functions/transpose.html

### Function subtract
Subtract two values, x - y. For matrices, the function is evaluated element wise.

Syntax
math.subtract(x, y)
https://mathjs.org/docs/reference/functions/subtract.html
