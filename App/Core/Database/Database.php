<?php

namespace myApp\Core\Database;

use Medoo\Medoo;
use myApp\Interfaces\DBInterface;

define('DB_CONFIG', require 'App/Config/DataBaseConfig.php');

class Database implements DBInterface
{
    private Medoo $database;
    public static ?Database $instance = null;

    public function __construct()
    {
        if (is_null(self::$instance)) {
            self::$instance = $this;
        }
        $this->database = new Medoo(DB_CONFIG);
    }

    public function storeDeals(int $clientId,string $partnerName,string $partnerMail): void
    {
        $this->database->insert(
            "deals",
            [
                "client_id" => $clientId,
                "partner_name" => $partnerName,
                "partner_mail" => $partnerMail,
                "status" => PARTNERS_CONFIG['defaultStatus'],
            ]
        );
    }

    public function storeClient(string $mail, string $amount): int
    {
        $this->database->insert(
            "applications",
            [
                "client_mail" => $mail,
                "amount" => $amount,
            ]
        );
        return $this->database->id();
    }

    public function changeStatus(string $id, string $status): void
    {
        $this->database->update(
            "deals",
            ["status" => $status],
            ['client_id' => $id]
        );
    }

    public function gedData(): array
    {
        return $this->database->select("deals", ["[><]applications" => ["client_id" => "id"]],'*');
    }

    public function getEmailById(string $id): string
    {
        return $this->database->get('deals', 'partner_mail', ['client_id' => $id]);
    }


    public static function getInstance(): self
    {
        return self::$instance ?? new Database();
    }
}