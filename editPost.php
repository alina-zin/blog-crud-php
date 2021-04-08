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
    $title=filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
    $text=filter_input(INPUT_POST,'text',FILTER_SANITIZE_STRING);
    $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);

    $kysely = $conn->prepare("UPDATE entry SET title = :title, text = :text WHERE id = :id");
    $kysely->bindValue(":title",$title, PDO::PARAM_STR);
    $kysely->bindValue(":text",$text, PDO::PARAM_STR);
    $kysely->bindValue(":id",$id, PDO::PARAM_INT);
    $kysely->execute();
    // palauttaa "etusivulle"
    header('Location: http://localhost/database/index.php');
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

