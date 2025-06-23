<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Validate the input data
    if (empty($email) || empty($password)) {
        // Handle the error, e.g., redirect back with an error message
        header('Location: /signin?error=Please fill in all fields');
        exit();
    }

    // Create a new User instance
    $user = new User();
    $checkLogin = $user->login($email, $password);
    if ($checkLogin) {
        global $db;
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $userData = $db->query($query, $params)->fetch();

        // Store user data in session
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_role'] = $userData['role'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_first_name'] = $userData['first_name'];
        $_SESSION['user_last_name'] = $userData['last_name'];

        header('Location: /');
        exit();
    } else {
        header('Location: /signin?error=Invalid email or password');
        exit();
    }

}
