<?php

$conn = mysqli_connect("localhost", "root", "", "review");

$userName = $_POST["name"] ?? "";
$userReview = $_POST["review"] ?? "";
$userRating = 5;

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
    echo "<script>console.log('[Please fill out the whole form]' );</script>";
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
    <div id = "inputPage">
        <h1 class="title">Review this website</h1>
        <div class="reviewStars"></div>
        <form action="index.php" method="post">
            <input id="inputBoxes" class="nameInput"  placeholder="Name" type="text" name="name" required><br>
            <textarea id="inputBoxes" class="reviewInput" maxlength="200" type="text" name="review" placeholder ="Review" required> </textarea><br>
            <input class="submitButton" type="submit" value="POST">
        </form>
    </div>
</body>
</html>


<?php

if ($conn) {
    $sql = "SELECT * FROM tb_reviews";
    $dbData = $conn->query($sql);
    if ($dbData->num_rows > 0) {
        while ($person = $dbData->fetch_assoc()) {
            echo "Username |" . $person["userName"] . " - Review | " . $person["review"] . " - Stars |" . $person["rating"] . "<br>";
        }

    } else {
        echo "[No reviews found]<br>";
    }
}

?>