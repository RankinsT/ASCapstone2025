<?php
// updateService.php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

require_once './models/model_admin.php';
require_once './models/db.php';

$serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
$type = isset($_POST['type']) ? $_POST['type'] : '';
$value = isset($_POST['value']) ? $_POST['value'] : '';

if ($serviceId < 0 || $serviceId > 6 || !in_array($type, ['title', 'desc'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

try {
    global $db;
    if ($type === 'title') {
    $stmt = $db->prepare('UPDATE textboxes SET section = ? WHERE id = ?');
        $stmt->execute([$value, $serviceId + 1]); // serviceId+1 matches your DB ids
    } else {
    $stmt = $db->prepare('UPDATE textboxes SET textBox = ? WHERE id = ?');
    $stmt->execute([$value, $serviceId + 1]);
    }
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage(), 'debug' => [
        'serviceId' => $serviceId,
        'type' => $type,
        'value' => $value
    ]]);
}
