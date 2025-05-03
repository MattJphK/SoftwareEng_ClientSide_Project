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

}


?>