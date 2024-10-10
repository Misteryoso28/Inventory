<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .navbar {
            background-color: white; /* Navbar background color */
            border-top: 4.5px solid #343a40; /* Line above the navbar */
            border-bottom: 4.5px solid #343a40; /* Line below the navbar */
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px; /* Space between logo and text */
            width: 75px; /* Set a specific width for the logo */
            height: 75px; /* Set a specific height for the logo */
        }
        .navbar-brand h1 {
            font-size: 1.5rem; /* Adjust font size */
            color: black; /* Change color of the header text */
        }
        .navbar-nav .nav-link {
            color: #343a40; /* Link color */
            padding: 0; /* Adjust the link padding */
        }
        .navbar-nav .nav-link:hover {
            color: #f8f9fa; /* Hover color for links */
            background-color: rgba(255, 255, 255, 0.1); /* Optional: background color on hover */
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="123.png" alt="Inventory Logo" class="align-top">
                    <h1>INVENTORY SYSTEM</h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
