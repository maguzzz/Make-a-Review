<?php

$conn = mysqli_connect("localhost", "root", "", "review");

$userName =  $_POST["name"] ?? "";
$userReview = $_POST["review"] ?? "";

$userName = filter_var($userName, FILTER_SANITIZE_STRING);
$userReview = filter_var($userReview, FILTER_SANITIZE_STRING);

if (!empty($userName) && !empty($userReview)) {

    $sql = "INSERT INTO tb_reviews (userName, review, postDate) VALUES ('$userName', '$userReview', DATE_FORMAT(NOW(), '%d.%m.%Y'))";

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
    <div id="inputPage">
        <h1 class="title">Review this website</h1>
        <form class="formCont" action="index.php" method="post">
            <input id="inputBoxes" class="nameInput" placeholder="Name" maxlength="16" type="text" name="name"
                required><br>
            <textarea id="inputBoxes" class="reviewInput" maxlength="200" type="text" name="review" placeholder="Review"
                required></textarea><br>
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
        $reversedData = [];
        while ($person = $dbData->fetch_assoc()) {
            $reversedData[] = "<div class ='reviewPost'>
                                <div class='postDate'>". $person["postDate"] ." </div>
                                <div class='postName'>" . $person['userName'] . "</div>
                                <div class ='postReview'> <a>". $person["review"] ."</a></div>
                              </div>";
        }

        $reversedData = array_reverse($reversedData);
        
        foreach ($reversedData as $review) {
            echo $review;
        }
        echo "<div class ='bottomSpacing'></div>";
    } else {
        echo "<h1 class='noDataError'>[NO DATA FOUND]</h1>";
    }
}

?>