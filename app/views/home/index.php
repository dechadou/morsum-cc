<?php use Src\View; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>MORSUM - MVC CC</title>
    <script>
        var BASEPATH = "<?php echo ROOT ?>";
    </script>
    <?php View::render('inc/styles') ?>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>MORSUM - Coding Challenge</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <?php View::render('home/search') ?>
    </div>
    <div class="row">
        <?php View::render('forms/addUser') ?>
        <?php View::render('home/users') ?>
    </div>
</div>


<?php View::render('modals/edit') ?>
<?php View::render('modals/delete') ?>
<?php View::render('inc/scripts') ?>

</body>
</html>