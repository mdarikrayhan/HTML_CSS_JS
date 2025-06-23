<?php
class User
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;

    private $phone;

    private $division;
    private $district;
    private $upazila;
    private $zipcode;

    public function __construct()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->division = '';
        $this->district = '';
        $this->upazila = '';
        $this->zipcode = '';
    }

    public function login($email, $password)
    {
        global $db;
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

    public function save($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode)
    {
        global $db; // Use the global database instance
        $query = "INSERT INTO users (email, password, first_name, last_name, phone, division, district, upazila, zipcode, created_at) 
                  VALUES (:email, :password, :first_name, :last_name, :phone, :division, :district, :upazila, :zipcode, NOW())";
        $params = [
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':division' => $division,
            ':district' => $district,
            ':upazila' => $upazila,
            ':zipcode' => $zipcode
        ];
        $db->query($query, $params);
    }
}

