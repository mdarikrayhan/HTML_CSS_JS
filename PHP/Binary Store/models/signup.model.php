<?php
class SignUpUser
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

    public function __construct($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->division = $division;
        $this->district = $district;
        $this->upazila = $upazila;
        $this->zipcode = $zipcode;
    }

    public function checkFirstUser()
    {
        global $db; // Use the global database instance
        $query = "SELECT COUNT(*) FROM users";
        $result = $db->query($query)->fetchAll();
        return $result[0]['COUNT(*)'] == 0;
    }
    public function save()
    {
        global $db; // Use the global database instance
        $query = "INSERT INTO users (role, email, password, first_name, last_name, phone, division, district, upazila, zipcode, created_at) 
                  VALUES (:role, :email, :password, :first_name, :last_name, :phone, :division, :district, :upazila, :zipcode, NOW())";
        $checkFirstUser = $this->checkFirstUser();
        if ($checkFirstUser) {
            $role = 'admin';
        } else {
            $role = 'user';
        }
        $params = [
            ':role' => $role,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':division' => $this->division,
            ':district' => $this->district,
            ':upazila' => $this->upazila,
            ':zipcode' => $this->zipcode
        ];
        $db->query($query, $params);
    }
}

