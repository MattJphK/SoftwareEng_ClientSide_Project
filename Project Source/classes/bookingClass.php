<?php
require "../src/DBconnect.php";

class bookingClass extends movieClass {
    private $bookingid;
    private $date;
    private $seating;
    private $cardName;
    private $cardNo;
    private $eirCode;
    private $cvc;
    private $movieid;
    private $userid;


    public function __construct($bookingid, $date, $seating, $cardName, $cardNo, $eirCode, $cvc, $movieid, $userid) {
        $this->bookingid= $bookingid;
        $this->date = $date;
        $this->seating = $seating;
        $this->cardName = $cardName;
        $this->cardNo = $cardNo;
        $this->eirCode = $eirCode;
        $this->cvc = $cvc;
        $this->movieid = $movieid;
        $this->userid = $userid;
    }

    public function getBookingid() {
        return $this->bookingid;
    }

    public function getDate() {
        return $this->date;
    }

    public function getSeating() {
        return $this->seating;
    }

    public function getCardName() {
        return $this->cardName;
    }

    public function getCardNo() {
        return $this->cardNo;
    }
    public function getEirCode() {
        return $this->eirCode;
    }

    public function getCvc() {
        return $this->cvc;
    }

    public function getMovieid() {
        return $this->movieid;
    }
    public function getUserId() {
        return $this->userid;
    }



}
