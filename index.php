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
    <link rel="stylesheet" href="Styles/index.css">
    <title>Review</title>
</head>

<body>
    <form action="index.php" method="post">
        <input class="nameInput"  placeholder="Name" type="text" name="name"><br>
        <textarea class="reviewInput" maxlength="200" placeholder="Review" type="text" name="review"> </textarea><br>
        <input type="submit" value="POST">
    </form>
</body>
</html>


<?php 

if($conn){
    $sql = "SELECT * FROM tb_reviews";
    $dbData = $conn->query($sql);
    if($dbData-> num_rows > 0){
        while($person = $dbData->fetch_assoc()) {
            echo "Username |" . $person["userName"] . " - Review | " . $person["review"] . " - Stars |" . $person["rating"] . "<br>";
        }

    }else{
        echo "[No reviews found]<br>";
    }
}

?>