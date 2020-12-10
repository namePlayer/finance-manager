<h4 class="float-start">Transaction Overview</h4>
<button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addNewTransactionModal">Add Transaction</button>

<br>

<hr>

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
    $stmt = $dbConnection->prepare('SELECT `transaction_id`,`name`,`description`,`amount` FROM `Transactions` WHERE `user` = :userId ORDER BY `transaction_id` DESC');
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

<div class="modal fade" id="addNewTransactionModal" tabindex="-1" aria-labelledby="addNewTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewTransactionModalLabel">Add new Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="newTransactionName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="newTransactionName" name="newTransactionName">
                    </div>
                    <div class="mb-3">
                        <label for="newTransactionDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="newTransactionDescription" name="newTransactionDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="newTransactionAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="newTransactionAmount" name="newTransactionAmount" aria-describedby="newTransactionAmountHelp">
                        <div id="newTransactionAmountHelp" class="form-text">Enter the amount without a comma.</div>
                    </div>
                    <div class="mb-3">
                        <label for="newTransactionDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="newTransactionDate" name="newTransactionDate" min="1970-01-01">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Transaction</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>