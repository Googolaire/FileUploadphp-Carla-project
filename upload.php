<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$servername = 'localhost';
$db_username = 'carlamaster';
$db_pass = 'C@Rl@Styl3Master';
$dbname = 'fashioncoordinators';
// Other POST elements
$img_name = $_POST["img_name"];
$style_category = $_POST["style_category"];
$style_found = $_POST["style_found"];
$img_added = $_POST["img_added"];

$conn = new mysqli($servername, $db_username, $db_pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO Styles (img_name, style_category, style_found, img_added)  VALUES ('$img_name', '$style_category', '$style_found', '$img_added');";

if ($conn->query($sql) === TRUE) {
    header("location: index.php?Subed&uploaded");
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 200000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $sql = "INSERT INTO Styles (img_name, style_category, style_found, img_added)  VALUES ($img_nam.$$fileNameNew, '$style_category', '$style_found', '$img_added');";
                mysqli_query($conn,$sql);
                $fileDestination = $_SERVER['DOCUMENT_ROOT'].'/styleuploads/';
                $moved = move_uploaded_file($fileTmpName, $fileDestination.$img_name.".".$fileNameNew);
                header("Location: index.php?uploadyay");
                exit;
            } else echo "Opps, your file is too big! It needs to be smaller than 200 Megabytes";
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You can not upload files of that type";
    }
}
?>  
