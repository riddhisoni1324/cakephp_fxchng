<?php

/* SMS Gateway

*/
//session_start();
require_once 'vendor/autoload.php';
use Guzzle\Http\Client;

class Sms
{
    public $Client;
    public $username;
    public $password;
    public $senderID;


    function __construct()
    {
        $this->username = "actonate";
        $this->password = "741980";
        $this->senderID = "FXCHNG";

        $this->Client = new Client('http://smslane.com');
        //$this->Client = new Client('http://127.0.0.1:8080');
    }

    //1. updateUserDetails(UserUpdateDetail userUpdateDetail)
    //Error 400
    //JSON Contains the firstName and lastName twice


    /*

       $sms = new Sms();
        if('check mobile number')
        {
          $sms->sendOfferConfirmation($addtitle,$name,$phno,$email,$offerprice);
        }

        public function sendOfferConfirmation($addtitle,$name,$phno,$email,$offerprice)
    {
        $url = "/vendorsms/pushsms.aspx?user=".$this->username."&password=".$this->password."&msisdn=91".$order_mobile."&sid=".$this->senderID."&msg=FXCHANG Support- ADD title: ##Field## ,Name: ##Field## ,PhoneNo: ##Field## ,Email: ##Field## ,Offer Price: ##Field## . Thanks, for more deatils visit fxchng.com .&fl=0&gwid=2";
        $request = $this->Client->get($url);


        $response = $request->send();
        //echo $response->getBody();
        return $response->getBody();
    }


    */

    public function sendMakeAnOffer($ad_title, $sender_name, $sender_mobile, $sender_email, $offer_rs, $receiver_mobile) {

        $url = "/vendorsms/pushsms.aspx?user=".$this->username."&password=".$this->password."&msisdn=91".$receiver_mobile."&sid=".$this->senderID."&msg=FXCHNG Support- Ad Title: ".$ad_title." ,Name: ".$sender_name." ,Phone No: ".$sender_mobile." ,Email: ".$sender_email." ,Offer Price: ".$offer_rs." . Thanks, for more deatils visit fxchng.com .&fl=0&gwid=2";
        // FXCHNG Support- Ad Title:  ##Field## ,Name:  ##Field## ,Phone No:  ##Field## ,Email:  ##Field## ,Offer Price:  ##Field## . Thanks, for more deatils visit fxchng.com .
        $request = $this->Client->get($url);
        $response = $request->send();
        return $response->getBody();
    }
}
?>