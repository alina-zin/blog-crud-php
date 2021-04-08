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
    $title=filter_input(INPUT_GET,'title',FILTER_SANITIZE_STRING);
    $text=filter_input(INPUT_GET,'text',FILTER_SANITIZE_STRING);
    /*print($title);
    print($text);*/
    $kysely = $conn->prepare("INSERT INTO entry (title, text) VALUES (:title,:text)");
    $kysely->bindValue(':title',$title, PDO::PARAM_STR);
    $kysely->bindValue(':text',$text, PDO::PARAM_STR);
    $kysely->execute();
    // palauttaa "etusivulle"
    header('Location: http://localhost/database/index.php');
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

