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
    $title=filter_input(INPUT_GET,'title',FILTER_SANITIZE_STRING);
    $text=filter_input(INPUT_GET,'text',FILTER_SANITIZE_STRING);

    print('<form action="editPost.php" method="post">
    <div>
        <label>Title</label>
        <input id="title" type="text" name="title" value="' . $title . '" maxlength="255" required />
    </div>
    <div>
        <label>Text</label>
        <textarea id="text" name="text" maxlength="255" required>'.$text.'</textarea>
        <input type="hidden" name="id" value="'.$postId.'" />
    </div>
    <input type="submit" value="Update" />
</form>');

    // palauttaa "etusivulle"
    //header('Location: http://localhost/database/index.php');
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}