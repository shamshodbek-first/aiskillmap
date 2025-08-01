<?php
header('Content-Type: application/json');

$csvDir = __DIR__ . '/data';
if (!is_dir($csvDir)) {
    mkdir($csvDir, 0777, true);
}
$csvFile = $csvDir . '/registrations.csv';
$file = fopen($csvFile, 'a');

if (filesize($csvFile) == 0) {
    fputcsv($file, [
        'Timestamp',
        'First Name',
        'Last Name',
        'Phone',
        'Email',
        'About',
        'Course'
    ]);
}

$data = json_decode(file_get_contents('php://input'), true);

$row = [
    $data['timestamp'] ?? date('Y-m-d H:i:s'),
    $data['firstName'] ?? '',
    $data['lastName'] ?? '',
    $data['phone'] ?? '',
    $data['email'] ?? '',
    $data['about'] ?? '',
    $data['course'] ?? ''
];

fputcsv($file, $row);
fclose($file);

echo json_encode(['success' => true]);