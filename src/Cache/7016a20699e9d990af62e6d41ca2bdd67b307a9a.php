<html>
    <head>
        <title>PHP MVC</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    </head>

    <body class="container">

        <!-- NAVBAR - HEADER -->
        <?php echo $__env->make('src.Layouts.Navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- ROUTES -->
        <?php echo $__env->make('src.Routes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </body>
</html><?php /**PATH C:\xampp\htdocs\yourlaravel\PHP_MVC/src/Views/Page.blade.php ENDPATH**/ ?>