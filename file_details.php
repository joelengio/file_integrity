<?php
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    
    $bytes /= (1 << (10 * $pow));
    
    return round($bytes, $precision) . ' ' . $units[$pow];
}

$filename = $_POST['filename'];

$file = "upload/" . $filename; // Path to the file

$fileDetails = [
  'size' => formatBytes(filesize($file)),
  'lastModified' => date("F d, Y H:i A", filemtime($file)),
  'creationDate' => date("F d, Y H:i A", filectime($file))
];

echo json_encode($fileDetails);
?>
