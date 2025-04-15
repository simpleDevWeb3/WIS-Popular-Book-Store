<?php/*
if (isset($_POST['upload'])) {
    $uploadDir = "IMG/image/"; // Folder where images will be stored
    $uploadFile = $uploadDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Allow only specific file types (JPG, PNG, GIF)
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move uploaded file to destination folder
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
        echo "Image uploaded successfully: <a href='$uploadFile'>View Image</a>";
    } else {
        echo "Error uploading image.";
    }
}*/
?>
