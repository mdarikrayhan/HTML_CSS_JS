<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $categoryName = $_POST['category_name'];
    $categoryDescription = $_POST['category_description'];
    $categoryUsersId = $_SESSION['user_id'];


    // File upload
    if (isset($_FILES["category_image"]) && $_FILES["category_image"]["error"] === UPLOAD_ERR_OK) {
        global $config;
        $uploadDir = $config['uploads']['path'].'categories/';
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES["category_image"]["name"]);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["category_image"]["tmp_name"], $targetPath)) {
            echo "<p>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";
            //Save the image path to $categoryImagePath
            $categoryImagePath = $targetPath;
            //Save the data to the database
            global $db;
            $query = "INSERT INTO categories (name, description, image_url, users_id) VALUES (:name, :description, :image_url, :users_id)";
            $params = [
                ':name' => $categoryName,
                ':description' => $categoryDescription,
                ':image_url' => $categoryImagePath,
                ':users_id' => $categoryUsersId
            ];
            $db->query($query, $params);

            //get back to the category view
            header("Location: /admin/category");
            exit;

        } else {
            echo "<p>File upload failed.</p>";
        }
    } else {
        echo "<p>No file uploaded.</p>";
    }

    // Redirect or display success message
    // header("Location: /admin/category");
    // exit;
}
