<?php

    $commentId=filter_input(INPUT_GET,"commentId",FILTER_SANITIZE_NUMBER_INT);
    $commentText=filter_input(INPUT_GET,"commentText",FILTER_SANITIZE_STRING);
?>

<form action="saveUpdatedComment.php" method="POST">
    <p>Muokkaa kommentti</p>
    <input type="text" required maxlength="255" name="commentText" value="<?php print($commentText); ?>" /> <br/>
    <input type="hidden" name="commentId" value="<?php print($commentId); ?>" />
    <input type="submit" value="Tallenna" />
</form>