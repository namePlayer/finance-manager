<?php


class UserUtils
{

    private $database;
    public $data;

    public function __construct(pdo $database, $userid)
    {
        $this->database = $database;

        $stmt = $database->prepare('SELECT `email`,`firstname`,`lastname`,`created`,`amount` FROM `Account` WHERE `account_id` = :accountId');
        $stmt->bindParam(':accountId', $userid);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $this->data = $stmt->fetch();
            return true;
        }

        return false;
    }
}