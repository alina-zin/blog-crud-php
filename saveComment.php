<?php
    $entry_id=filter_input(INPUT_POST,"entryId",FILTER_SANITIZE_NUMBER_INT);
    $commentText=filter_input(INPUT_POST,"commentText",FILTER_SANITIZE_STRING);

    $servername = "localhost";
    $username = "blogUser";
    $password = "jdPwvgmtqASH3Kl6";
    $dbname = "blog";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $kysely = $conn->prepare("INSERT INTO comments (entry_id, text) VALUES (:entry_id, :text)");
        $kysely->bindValue(":entry_id", $entry_id,PDO::PARAM_INT);
        $kysely->bindValue(":text", $commentText,PDO::PARAM_STR);

        $kysely->execute();

        // redirect etusivulle
        header('Location: http://localhost/database/index.php');
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>