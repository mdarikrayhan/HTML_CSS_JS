<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/banner.php') ?>

<?php
global $db;

// Extract product ID from URL
$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/product\/single\/(\d+)$/', $uri, $matches)) {
  $id = (int) $matches[1];
  $query = "SELECT * FROM products WHERE id = :id";
  $params = [':id' => $id];
  $product = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);

  if (!$product) {
    // Product not found
    http_response_code(404);
    echo "<h1>Product not found.</h1>";
    require('views/partials/footer.php');
    exit;
  }
} else {
  http_response_code(400);
  echo "<h1>Invalid product URL.</h1>";
  require('views/partials/footer.php');
  exit;
}
?>

<div class="bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Product Image -->
      <div class="md:w-1/2">
        <img src="/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
          class="w-full object-cover rounded-lg shadow-lg">
      </div>

      <!-- Product Details -->
      <div class="md:w-1/2 space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">
          <?= htmlspecialchars($product['name']) ?>
        </h1>

        <div class="text-2xl font-semibold text-gray-900">
          $<?= number_format($product['price'], 2) ?>
        </div>

        <div class="text-lg text-gray-600">
          In Stock: <?= htmlspecialchars($product['quantity']) ?> units
        </div>

        <div class="text-gray-600">
          <p><?= htmlspecialchars($product['description']) ?></p>
        </div>

        <form class="pt-4">
          <button type="submit"
            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200">
            Add to Cart
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require('views/partials/footer.php') ?>