<?php

$conn = mysqli_connect("localhost", "root", "", "review");

$userName = $_POST["name"] ?? "";
$userReview = $_POST["review"] ?? "";
$userRating = 5;

if (!$conn) {
    echo "[Connection failed]<br>";
}

echo "[Connected successfully]<br>";


if (!empty($userName) && !empty($userReview)) {

    $sql = "INSERT INTO tb_reviews (userName, review, rating) VALUES ('$userName', '$userReview', '$userRating')";

    if ($conn->query($sql) === true) {
        echo "[New review created successfully]<br>";
        header("Location: index.php");
        exit();
    } else {
        echo "[Error creating review]<br>";
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "[Please fill out the whole form]<br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
</head>

<body>
    <form action="index.php" method="post">
        <label>name:</label>
        <input type="text" name="name"><br>
        <label>review:</label>
        <input type="text" name="review"><br>
        <input type="submit" value="POST">
    </form>

</body>
</html>
