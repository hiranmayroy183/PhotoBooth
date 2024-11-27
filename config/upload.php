<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $caption = isset($_POST['caption']) ? $_POST['caption'] : '';
    $feeling = isset($_POST['feeling']) ? $_POST['feeling'] : '';
    $place = isset($_POST['place']) ? $_POST['place'] : '';
    $captureDate = isset($_POST['date']) ? $_POST['date'] : '';

    $uploadDir = '../uploads/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 20 * 1024 * 1024; // 20MB
    $uploadSuccess = true; // Track overall upload success

    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $fileType = $_FILES['images']['type'][$key];
            $fileSize = $_FILES['images']['size'][$key];
            $filePath = $uploadDir . uniqid() . '_' . $fileName;

            // Validate file type and size
            if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
                if (!move_uploaded_file($tmpName, $filePath)) {
                    $uploadSuccess = false;
                } else {
                    // Save metadata in the database
                    $stmt = $pdo->prepare("INSERT INTO images 
                        (user_name, email, phone, caption, feeling, place, capture_date, file_name) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    if (!$stmt->execute([$userName, $email, $phone, $caption, $feeling, $place, $captureDate, basename($filePath)])) {
                        $uploadSuccess = false;
                    }
                }
            } else {
                $uploadSuccess = false;
            }
        }
    }

    // Redirect with status
    $status = $uploadSuccess ? 'success' : 'error';
    header("Location: ../contribute.php?status=$status");
    exit;
}
?>
