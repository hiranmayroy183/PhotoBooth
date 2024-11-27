<?php
include 'db.php';

$year = isset($_GET['year']) ? $_GET['year'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    // Base query
    $query = "SELECT * FROM images WHERE 1";
    $params = [];

    // Add year filter
    if ($year) {
        $query .= " AND YEAR(capture_date) = ?";
        $params[] = $year;
    }

    // Add month filter
    if ($month) {
        $query .= " AND MONTH(capture_date) = ?";
        $params[] = $month;
    }

    // Add search filter
    if ($search) {
        $query .= " AND place LIKE ?";
        $params[] = "%" . $search . "%";
    }

    // Sort results
    $query .= " ORDER BY upload_time DESC";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    // Fetch all images
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($images);
} catch (PDOException $e) {
    // Return an error response
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
