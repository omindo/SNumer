<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S.Numer</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <?php include("menu.php"); ?>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="js/jquery-3.3.1.slim.min.js">
    </script>
    <!-- Popper.JS -->
    <script src="js/popper.min.js">
    </script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js">
    </script>
    <!-- Menu -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
    </script>

    <script src="js/math.js"></script>
    <script src="js/plotly-1.35.2.min.js"></script>
    <script src="js/algebrite.bundle-for-browser.js"></script>

</body>

</html>