<?php
header('Content-Type: application/json');

// Security checks (implement proper authentication in production)
$uploadDir = 'public_docs/';
if (isset($_POST['isProtected']) && $_POST['isProtected'] === 'true') {
    $uploadDir = 'protected_docs/';
}

$maxFileSize = 5 * 1024 * 1024; // 5MB

if ($_FILES['certificate']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'error' => 'File upload error']);
    exit;
}

if ($_FILES['certificate']['size'] > $maxFileSize) {
    echo json_encode(['success' => false, 'error' => 'File too large']);
    exit;
}

$fileExtension = strtolower(pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION));
if ($fileExtension !== 'pdf') {
    echo json_encode(['success' => false, 'error' => 'Only PDF files allowed']);
    exit;
}

$fileName = uniqid() . '.' . $fileExtension;
$targetPath = $uploadDir . $fileName;

if (move_uploaded_file($_FILES['certificate']['tmp_name'], $targetPath)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'File move failed']);
}
?>