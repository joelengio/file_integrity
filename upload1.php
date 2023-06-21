<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = 'uploads/';
    $uploadSuccess = false;

    if (!empty($_FILES['file']['name'])) {
        $fileName = basename($_FILES['file']['name']);
        $targetPath = $targetDir . $fileName;
        $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

        // Check if the file is valid
        $validFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileType), $validFileTypes)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                $uploadSuccess = true;
            }
        }
    }

    if ($uploadSuccess) {
        echo "File uploaded successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $imageFiles = glob('uploads/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    foreach ($imageFiles as $image) {
        echo '<div class="dz-preview">';
        echo '<div class="dz-image"><img src="' . $image . '"></div>';
        echo '<div class="dz-details"><span class="dz-remove" data-file="' . $image . '">Remove</span></div>';
        echo '</div>';
    }
}
?>
