<?php
include 'db.php';

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");

// Fetch items with their categories
$items = $conn->query("SELECT items.*, categories.category_name FROM items LEFT JOIN categories ON items.category_id = categories.category_id");
?>

<?php include 'header.php'; ?>

<div class="container">
<br>
    <h1>Items</h1>
    <a href="add_item.php" class="btn btn-primary mb-3">Add Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $items->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($row['unit_price']); ?></td>
                    <td>
                        <a href="edit_item.php?id=<?php echo $row['item_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_item.php?id=<?php echo $row['item_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
