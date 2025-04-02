<!-- connections.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Connections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    $currentUserId = $_SESSION['user_id'] ?? 1; // Replace with actual session logic
    ?>

    <div class="container my-6">
        <!-- Connections List -->
        <h3 class="mb-4">My Connections</h3>
        <div class="row g-6" id="connections-list">
            <!-- Connections will be populated here -->
        </div>

        <!-- Recommended Connections -->
        <h3 class="mt-6 mb-4">Recommended Connections</h3>
        <div class="row g-6" id="recommended-list">
            <!-- Recommendations will be populated here -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
   
</body>

</html>