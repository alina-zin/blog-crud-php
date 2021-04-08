<!DOCTYPE html>
<html>
    <head>
        <title>Blog</title>
    </head>
    <body>
        <h1>My blog</h1>
        <form action="create.php" method="GET">
            <div>
                <label>Title</label>
                <input id="title" type="text" name="title" maxlength="255" required />
            </div>
            <div>
                <label>Text</label>
                <textarea id="text" name="text" maxlength="255" required></textarea>
            </div>
            <input type="submit" value="Add new" />
        </form>
    </body>
    <div id="entries">
    <?php
        require "readComments.php";
        $servername = "localhost";
        $username = "blogUser";
        $password = "jdPwvgmtqASH3Kl6";
        $dbname = "blog";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT id, title, text, added FROM entry");
            $stmt->execute();

            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // haetaan kaikki SQL:n palauttamat rivit ja tallennetaan ne $result -muuttujaan
            $result = $stmt->fetchAll();

            // tämä käsky tulostaa $result -muuttujan sivulle
            //print_r($result);
            //foreach on hyvä tulostamaan monta riviä:
                foreach($result as $row) {
                    print("<hr/>");

                    //timestamp
                    print("<i>");
                    print($row['added']);
                    print("</i>");

                    //title
                    print("<h3>");
                    print($row['title']); //tai $row->title
                    print("</h3>");

                    //text
                    print("<p><i>");
                    print($row['text']); //tai $row->text
                    print("</i></p>");

                    //muuttujat napeille
                    $postId = $row['id'];
                    $title = $row['title'];
                    $text = $row['text'];
                   // $writeComment = $row['text'];

                    //delete-nappi
                    print("<a href='delete.php?id=$postId'>Delete</a>");

                    print("&nbsp; | &nbsp;");

                    //update-nappi
                    print("<a href='update.php?title=$title&text=$text&id=$postId'>Update</a>");

                    // Kommentit ja kommentointimahdollisuus
                    print("<h5>Comments</h5>");

                    readComments($postId);

                    print("<a href='comments.php?entry_id=$postId'>Leave a comment</a>");

                    print("<hr/>");

                }

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>
</html>