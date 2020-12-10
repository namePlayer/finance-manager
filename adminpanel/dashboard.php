<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header text-center">
                Balance
            </div>
            <div class="card-body text-center">
                <?= convertToMoney($userUtils->data['amount']) ?> €
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header text-center">
                Last Transaction
            </div>
            <div class="card-body text-center">
                <?php
                $stmt = $dbConnection->prepare('SELECT `name`,`description`,`amount` FROM `Transactions` WHERE `user` = :userId ORDER BY `transaction_id` DESC LIMIT 1');
                $stmt->bindParam(':userId', $_SESSION['user_login']);
                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();

                    $money = convertToMoney($data['amount']).' €';
                    if($data['amount'] < 0) {
                        $money = '<span class="text-danger">'.convertToMoney($data['amount']).' €</span>';
                    }
                    ?>
                    <b><?= $data['name'] ?></b> | <?= $money ?>
                    <hr>
                    <p><?= $data['description'] ?></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header text-center">
                Last Balance Statement
            </div>
            <div class="card-body text-center">
                31.11.2020
            </div>
        </div>
    </div>
</div>

<hr>
<h4>Transaction Overview</h4>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Transaction #</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Charged</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $dbConnection->prepare('SELECT `transaction_id`,`name`,`description`,`amount` FROM `Transactions` WHERE `user` = :userId ORDER BY `transaction_id` DESC LIMIT 5');
    $stmt->bindParam(':userId', $_SESSION['user_login']);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $money = convertToMoney($row['amount']).' €';
        if($row['amount'] < 0) {
            $money = '<span class="text-danger">'.convertToMoney($row['amount']).' €</span>';
        }

        ?>
        <tr>
            <th scope="row"><?= $row['transaction_id'] ?></th>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $money ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>