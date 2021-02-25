<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/styles.css">
    <script src="../static/js/vue.js"></script>
</head>
<body>
<div class="wrapper">
    <?php include "includes/header.php" ?>
    <script> let DATA = <?= $DATA ?></script>
    <div class="content"><?php include "$templateName.php" ?></div>
    <?php include 'includes/footer.php' ?>
</div>
</body>
</html>