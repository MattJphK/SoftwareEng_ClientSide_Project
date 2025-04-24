
<?php require "../Project Source/public/template/header.php"; ?>

<h1>Booking Test: Card Getters</h1>
<?php
require_once "./classes/bookingClass.php";

$cards = ["1111111111111","2222222222222222222","3333333333333333","444444444444444444"];

foreach($cards as $cardNo){
    $booking = new bookingClass(1,"2025-05-05","A5","Matthew",$cardNo,"D15DC1","123",10,1);
    if($booking->getCardNo() == $cardNo){
        echo "<p>Card Number: ".$booking->getCardNo()."</p><br>";
    }
    else{
        echo "<p>Card Test Unsuccessful: </p>";
    }


}

?>
<?php require "../Project Source/public/template/footer.php";

