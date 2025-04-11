<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h1>Form Submitted Successfully!</h1>";

    // Vehicle checkboxes
    echo "<p>Bike: " . (isset($_POST["vehicle1"]) ? "Yes" : "No") . "</p>";
    echo "<p>Car: " . (isset($_POST["vehicle2"]) ? "Yes" : "No") . "</p>";
    echo "<p>Boat: " . (isset($_POST["vehicle3"]) ? "Yes" : "No") . "</p>";

    // Gender (radio)
    echo "<p>Gender: " . (isset($_POST["gender"]) ? htmlspecialchars($_POST["gender"]) : "Not selected") . "</p>";

    // Textual inputs
    echo "<p>Email: " . htmlspecialchars($_POST["email"]) . "</p>";
    echo "<p>Password: " . htmlspecialchars($_POST["password"]) . "</p>";
    echo "<p>Telephone: " . htmlspecialchars($_POST["phone"]) . "</p>";
    echo "<p>Website: " . htmlspecialchars($_POST["website"]) . "</p>";
    echo "<p>Search: " . htmlspecialchars($_POST["search"]) . "</p>";
    echo "<p>Text: " . htmlspecialchars($_POST["text"]) . "</p>";

    // Number & range
    echo "<p>Number: " . htmlspecialchars($_POST["quantity"]) . "</p>";
    echo "<p>Range: " . htmlspecialchars($_POST["volume"]) . "</p>";

    // Date & time
    echo "<p>Date: " . htmlspecialchars($_POST["date"]) . "</p>";
    echo "<p>Time: " . htmlspecialchars($_POST["time"]) . "</p>";
    echo "<p>DateTime: " . htmlspecialchars($_POST["datetime"]) . "</p>";
    echo "<p>Month: " . htmlspecialchars($_POST["month"]) . "</p>";
    echo "<p>Week: " . htmlspecialchars($_POST["week"]) . "</p>";

    // Color
    echo "<p>Favorite Color: " . htmlspecialchars($_POST["color"]) . "</p>";

    // Hidden input
    echo "<p>Hidden Field: " . htmlspecialchars($_POST["hiddenField"]) . "</p>";

    // File upload
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $uploadDir = "file:///Applications/XAMPP/xamppfiles/temp/uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES["file"]["name"]);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
            echo "<p>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";
        } else {
            echo "<p>File upload failed.</p>";
        }
    } else {
        echo "<p>No file uploaded.</p>";
    }

} else {
    echo "<p>No form submitted.</p>";
}
?>
