<?php
require_once __DIR__.'/../includes/csrf-protection.php';

if(isLoggedIn()) {
    header("Location: ".$urlPath."/dashboard");
}

if(isset($_POST['loginEmail'], $_POST['loginPassword'], $_POST['_token'])) {

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $executeLogin = true;

    if($oneTimeTokenInvalid === true) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Your Token is invalid!'];
        $executeLogin = false;
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an valid Email!'];
        $executeLogin = false;
    }

    if(empty($password)) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'Please enter an Password!'];
        $executeLogin = false;
    }

    $stmt = $dbConnection->prepare('SELECT `password`,`account_id` FROM `Account` WHERE `email` = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $data = $stmt->fetch();

    if($stmt->rowCount() === 0 && $executeLogin === true) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'An error occurred, please try again!'];
        $executeLogin = false;
    }

    if($executeLogin === TRUE) {

        if(password_verify($password, $data['password'])) {
            $errorMessages[] = ['type' => 'success', 'message' => 'You were successfully logged in!'];

            $_SESSION['user_login'] = $data['account_id'];

            header("Location: ".$urlPath."/dashboard");

            $executeLogin = false;
        }

    }

    if($executeLogin === TRUE) {
        $errorMessages[] = ['type' => 'danger', 'message' => 'An error occurred, please try again!'];
    }

}

require_once __DIR__.'/../page/login.php';