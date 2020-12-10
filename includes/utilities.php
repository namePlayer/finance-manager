<?php

function renderTemplate(string $name, array $arguments = []): void {
    ob_start();

    extract($arguments);

    include(__DIR__. '/../template/' . $name . '.php');

    echo ob_get_clean();
}

function isLoggedIn(): bool {
    if(isset($_SESSION['user_login'])) {
        return true;
    }

    return false;
}

function convertToMoney(int $cent):string{
    $money = $cent/100;
    return number_format($money,2,",",".");
}