<?php
include 'db.php';

// Fetch categories for the dropdown
$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];

    // Remove the peso sign and commas from the unit price
    $unit_price = str_replace(['₱', ','], '', $_POST['unit_price']); // Remove currency symbol and commas
    $unit_price = floatval($unit_price); // Convert to float for database

    $date_added = date('Y-m-d H:i:s');
    $last_modified = date('Y-m-d H:i:s');

    // Check if the item already exists with the same name, category, and price
    $stmt = $conn->prepare("SELECT quantity FROM items WHERE item_name = ? AND category_id = ? AND unit_price = ?");
    $stmt->bind_param("sis", $item_name, $category_id, $unit_price);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Item exists, update the quantity
        $existing_item = $result->fetch_assoc();
        $new_quantity = $existing_item['quantity'] + $quantity;

        $update_stmt = $conn->prepare("UPDATE items SET quantity = ?, last_modified = ? WHERE item_name = ? AND category_id = ? AND unit_price = ?");
        $update_stmt->bind_param("isssi", $new_quantity, $last_modified, $item_name, $category_id, $unit_price);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Item does not exist, insert a new item
        $stmt = $conn->prepare("INSERT INTO items (item_name, description, category_id, quantity, unit_price, date_added, last_modified) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiiss", $item_name, $description, $category_id, $quantity, $unit_price, $date_added, $last_modified);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: index.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1>Add Item</h1>
    <div class="form-container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $row['category_id']; ?>"><?php echo htmlspecialchars($row['category_name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group position-relative">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="unit_price">Unit Price:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="unit_price" placeholder="₱" name="unit_price" oninput="formatCurrency(this)" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Item</button>
            <a href="index.php" class="btn btn-secondary">Back to Inventory</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function formatCurrency(input) {
        // Remove any non-digit characters except for commas
        const value = input.value.replace(/[^\d,]/g, '');
        const numericValue = value.replace(/,/g, ''); // Remove commas for conversion

        // Convert to number and format with commas
        const formattedValue = new Intl.NumberFormat().format(numericValue);

        // Set the input value with peso sign for display
        input.value = '₱' + formattedValue;

        // Store the numeric value for submission
        input.dataset.numericValue = numericValue; // Store the raw number
    }
</script>
</body>
</html>
