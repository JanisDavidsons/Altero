<?php
namespace myApp\Interfaces;

interface DBInterface
{
    public function storeClient(string $mail,string $password):int ;
    public function storeDeals(int $clientId,string $partnerName,string $partnerMail):void ;
    public function changeStatus(string $id, string $status): void;
    public function getEmailById(string $id): string;
    public static function getInstance(): self;
    public function gedData(): array;
}