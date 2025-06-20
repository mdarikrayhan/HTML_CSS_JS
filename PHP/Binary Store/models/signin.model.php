<?php
class SignInUser
{
    private $role; // Default role for users
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $phone;
    private $division;
    private $district;
    private $upazila;
    private $zipcode;

    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;

    }
    public function login()
    {
        global $db;
        $email = $this->email;
        $password = $this->password;



        $query = "SELECT password FROM users WHERE email = :email";
        $params = [':email' => $email];
        $hashedPasswordResult = $db->query($query, $params)->fetchColumn();

        if ($hashedPasswordResult && password_verify($password, $hashedPasswordResult)) {

            return true; // Login successful
        }
        return false; // Login failed

    }
    public function getUserData()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'division' => $this->division,
            'district' => $this->district,
            'upazila' => $this->upazila,
            'zipcode' => $this->zipcode
        ];
    }

}
