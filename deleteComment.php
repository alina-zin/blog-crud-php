<?php
    $commentId=filter_input(INPUT_GET,"commentId",FILTER_SANITIZE_NUMBER_INT);

    $servername = "localhost";
    $username = "blogUser";
    $password = "jdPwvgmtqASH3Kl6";
    $dbname = "blog";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $kysely = $conn->prepare("DELETE FROM comments WHERE id = :commentId");
        $kysely->bindValue(":commentId", $commentId,PDO::PARAM_INT);

        $kysely->execute();

        // redirect etusivulle
        header('Location: http://localhost/database/index.php');
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>