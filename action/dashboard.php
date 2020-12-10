<?php

if(!isLoggedIn()) {
    header("Location:".$urlPath."/login");
    exit();
}

$userUtils = new UserUtils($dbConnection, $_SESSION['user_login']);

if(isset($_POST['newTransactionName'], $_POST['newTransactionDescription'], $_POST['newTransactionAmount'],$_POST['newTransactionDate'])) {

    $execute = true;

    $name = $_POST['newTransactionName'];
    $description = $_POST['newTransactionDescription'];
    $amount = (int)$_POST['newTransactionAmount'];
    $transactionDate = DateTime::createFromFormat('Y-m-d', $_POST['newTransactionDate']);

    $minDate = new DateTime('1970-01-01');

    if($transactionDate <= $minDate) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an valid transaction date higher than 01.01.1970'];
        $execute = false;
    }

    if(empty($name)) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an valid transaction name'];
        $execute = false;
    }

    if(empty($amount) || !is_int($amount)) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an valid transaction amount!'];
        $execute = false;
    }

    if($transactionDate == false) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an valid transaction date'];
        $execute = false;
    }

    $transDate = 0;
    if($execute) {
        $transDate = $transactionDate->getTimestamp();
    }

    $stmt = $dbConnection->prepare('INSERT INTO `Transactions` SET `name` = :name, `description` = :description, `user` = :userId, `amount` = :amount, `time` = :currentTime');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':userId', $_SESSION['user_login']);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':currentTime', $transDate);

    $stmt1 = $dbConnection->prepare("UPDATE `account` SET `amount` = (`amount` + :amount) WHERE `account_id` = :accountId");
    $stmt1->bindParam(':amount', $amount);
    $stmt1->bindParam(':accountId', $_SESSION['user_login']);
    if($execute) {
        if($stmt->execute() && $stmt1->execute()) {
            $errorMessages[] = ['type' => 'success', 'message' => 'Successfully added a new transaction to the list.'];
            $execute = false;
        }
    }

    if($execute === true) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Sorry, something went wrong while adding the transaction.'];
    }
}

require_once __DIR__.'/../page/dashboard.php';