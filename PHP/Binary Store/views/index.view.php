<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php
        if (isset($_SESSION['user_id'])) {
            global $db;
            $query = "SELECT * FROM users WHERE id = :id";
            $params = [':id' => $_SESSION['user_id']];
            $user = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
            // Show user profile
            echo "Welcome: " . htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . "<br>";
        
        }
        else {
            echo "Welcome, Guest! Please log in to see your profile information.";
        }
        ?>
    </div>
</main>

<?php require('partials/footer.php') ?>
