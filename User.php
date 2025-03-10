<?php
class User
{
    public $username;
    public $password;
    public $email;
    public $age;
    public $userscore;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setUserscore($userscore)
    {
        $this->userscore = $userscore;
    }

    public function getUserscore()
    {
        return $this->userscore;
    }

    public function display User(){
     echo "<br>---------------------------"
    echo "Username: ".$this->username."<br>";
    echo "Password: ".$this->password."<br>";
    echo "Email: ".$this->email."<br>";
    echo "Age: ".$this->age."<br>";
    echo "Userscore: ".$this->userscore."<br>";
    }
}
    $userA = new User();
    $userA->setUsername("userA");
    $userA->setPassword("userA");
    $userA->setEmail("userA@gmail.com");
    $userA->setAge(18);
    $userA->setUserscore(100);
    $userA->display ();
    $userB = new User();
    $userB->setUsername("userB");
    $userB->setPassword("userB");
    $userB->setEmail("userB@gmail.com");
    $userB->setAge(20);
    $userB->setUserscore(50);
    $userB->display ();

?>