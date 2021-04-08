<?php
$servername = "localhost";
$username = "blogUser";
$password = "jdPwvgmtqASH3Kl6";
$dbname = "blog";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $postId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $kysely = $conn->prepare("DELETE FROM entry WHERE id=:id");
    $kysely->bindValue(':id',$postId, PDO::PARAM_INT);
    $kysely->execute();
    // palauttaa "etusivulle"
    header('Location: http://localhost/database/index.php');
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}