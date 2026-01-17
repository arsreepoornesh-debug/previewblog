<?php
function uploadImage($file, $folder) {

    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== 0) {
        return null;
    }

    if (!in_array($file['type'], $allowedTypes)) {
        return null;
    }

    if ($file['size'] > $maxSize) {
        return null;
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = time() . "_" . rand(1000,9999) . "." . $extension;

    $uploadPath = "../../uploads/$folder/" . $newName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return "uploads/$folder/" . $newName; // DB-la save pannum path
    }

    return null;
}
