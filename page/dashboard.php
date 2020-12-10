<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $urlPath ?>/assets/bootstrap.min.css">
</head>
<body>
<?php require_once __DIR__.'/../assets/navbar.php'; ?>

<div class="container mt-5">
    <?php
    foreach ($errorMessages as $errorMessage) {
        $args = ['type' => $errorMessage['type'], 'message' => $errorMessage['message']];
        renderTemplate('alert', $args);
    }
    ?>

    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <a href="<?= $urlPath ?>/dashboard" class="list-group-item list-group-item-action active">
                    Finance Manager
                </a>
                <a href="<?= $urlPath ?>/dashboard/transactions" class="list-group-item list-group-item-action">Last Transactions</a>
                <a href="<?= $urlPath ?>/dashboard/statements" class="list-group-item list-group-item-action">Balance Statements</a>
                <a href="<?= $urlPath ?>/dashboard/logout" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>
        <div class="col-9">
            <?php require_once __DIR__.'/../adminpanel/'.$dashboardPage.'.php'; ?>
        </div>
    </div>

</div>

<script src="<?= $urlPath ?>/assets/bootstrap.min.js"></script>

</body>
</html>