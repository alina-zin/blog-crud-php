<?php
function readComments($postId) {
    $servername = "localhost";
    $username = "blogUser";
    $password = "jdPwvgmtqASH3Kl6";
    $dbname = "blog";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM comments WHERE entry_id = :id");
        $stmt->bindValue(":id",$postId, PDO::PARAM_INT);

        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // haetaan kaikki SQL:n palauttamat rivit ja tallennetaan ne $result -muuttujaan
        $result = $stmt->fetchAll();
        print("<ol>");
         foreach($result as $row) {
             print("<li>");
             print($row['text'] . " " . $row['added']);

             $commentId = $row['id'];
             $commentText = $row['text'];
            
             print(" |  <a href='deleteComment.php?commentId=$commentId'>Delete</a> |  <a href='updateComment.php?commentId=$commentId&commentText=$commentText'>Update</a>");
             print("</li>");
         }
        print("</ol>");
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>