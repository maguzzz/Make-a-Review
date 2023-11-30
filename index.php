<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
</head>

<body>
    <?php
session_start();
        $conn = mysqli_connect("localhost", "root", "", "review");

        if(!$conn) {
            echo "Connection failed <br>";
        }
        echo "Connected successfully <br>";
    ?>


</body>

</html>