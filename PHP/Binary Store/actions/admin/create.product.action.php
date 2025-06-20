<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productUsersId = $_SESSION['user_id'];
    $productPrice = $_POST['product_price'];
    $productQuantity = $_POST['product_quantity'];
    $productCategory = $_POST['product_category'];



    // File upload
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] === UPLOAD_ERR_OK) {
        global $config;
        $uploadDir = $config['uploads']['path'].'products/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }   

        $fileName = basename($_FILES["product_image"]["name"]);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetPath)) {
            echo "<p>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";
            //Save the image path to $productImagePath
            $productImagePath = $targetPath;
            //Save the data to the database
            global $db;
            $query = "INSERT INTO products (name, description, image_url, users_id, price, quantity, category_id) VALUES (:name, :description, :image_url, :users_id, :price, :quantity, :category_id)";
            $params = [
                ':name' => $productName,
                ':description' => $productDescription,
                ':image_url' => $productImagePath,
                ':users_id' => $productUsersId,
                ':price' => $productPrice,
                ':quantity' => $productQuantity,
                ':category_id' => $productCategory
            ];
            $db->query($query, $params);

            //get back to the product view
            header("Location: /admin/product");
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
