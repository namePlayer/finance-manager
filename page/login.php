<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finance Manager | Login</title>
    <link rel="stylesheet" href="<?= $urlPath ?>/assets/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">

        <?php
        foreach ($errorMessages as $errorMessage) {
            $args = ['type' => $errorMessage['type'], 'message' => $errorMessage['message']];
            renderTemplate('alert', $args);
        }
        ?>

        <form action="" method="post">
            <div class="card">
                <div class="card-header text-center"><b>Finance Manager - Login</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">E-Mail</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                    </div>
                    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark float-end">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>