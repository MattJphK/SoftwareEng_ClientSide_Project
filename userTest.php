<?php
class userTest {
    public $email;
    public $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function credentialCheck() {
        echo "</br>User {$this->email} is logging in with password {$this->password}.";
    }// This function would be used to compare to DB PASSWORD FOR THAT USER


    public function matchDetails($inputEmail, $inputPassword) {
        return $this->email == $inputEmail
            && $this->password == $inputPassword;
    }
}



/*$myuser = new User("matthew@gmail.com", "123");
$myuser->credentialCheck();*/

?>
