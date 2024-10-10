<?php
include 'db.php';

$item_id = $_GET['id'];

// Fetch the item to be edited
$stmt = $conn->prepare("SELECT * FROM items WHERE item_id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch categories for the dropdown
$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $last_modified = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE items SET item_name = ?, description = ?, category_id = ?, quantity = ?, unit_price = ?, last_modified = ? WHERE item_id = ?");
    $stmt->bind_param("ssiiisi", $item_name, $description, $category_id, $quantity, $unit_price, $last_modified, $item_id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1>Edit Item</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($item['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php while ($row = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $row['category_id']; ?>" <?php echo $row['category_id'] == $item['category_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['category_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group position-relative">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required>
        </div>

        <div class="form-group">
                <label for="unit_price">Unit Price:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="unit_price" placeholder="₱" name="unit_price" oninput="formatCurrency(this)" required>
                </div>
            </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="index.php" class="btn btn-secondary">Back to Inventory</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function formatCurrency(input) {
        const value = input.value.replace(/[^0-9]/g, '');
        const formattedValue = new Intl.NumberFormat().format(value);
        input.value = formattedValue;
    }
</script>
</body>
</html>
