<?php

namespace myApp\Controllers;
use myApp\Core\View;
define('PARTNERS_CONFIG', require 'App/Config/PartnersConfig.php');

class DealsController
{
    public function store()
    {
        $mail = $_POST['mail'];
        $amount = $_POST['amount'];
        $partnerName = null;
        $partnerMail = null;

        if (!validator()->validateAmount($amount)) {
            View::show('Show.php', ['Entered amount is incorrect!']);
            return;
        }
        if ($amount > PARTNERS_CONFIG['amountThreshold']) {
            $partnerName = PARTNERS_CONFIG['partnerOneName'];
            $partnerMail = PARTNERS_CONFIG['partnerOneMail'];
        } else {
            $partnerName = PARTNERS_CONFIG['partnerTwoName'];
            $partnerMail = PARTNERS_CONFIG['partnerTwoMail'];
        }

        mailer()->sendEmail(
            $partnerMail,
            'Thank you for choosing Altero!',
            'Your request is being processed! Best regards, Altero.'
        );

        $clientId = database()->storeClient($mail, $amount);
        database()->storeDeals($clientId, $partnerName, $partnerMail);
        header('Location: ' . '/?message=Thank you, email is sent!');
    }

    public function changeStatus(array $data)
    {
        database()->changeStatus($data['id'], PARTNERS_CONFIG['offerStatus']);
        $partnerMail = database()->getEmailById($data['id']);

        mailer()->sendEmail(
            $partnerMail,
            'New client request!',
            ' You have new client request! Best regards, Altero.'
        );
        header('Location: ' . '/getData?message=Email has been sent!');
    }

    public function getData()
    {
        $data = database()->gedData();
        View::show('Records.php', $data);
    }

    public function show()
    {
        View::show('Show.php');
    }
}
