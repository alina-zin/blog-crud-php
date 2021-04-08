<?php

    $entry_id=filter_input(INPUT_GET,"entry_id",FILTER_SANITIZE_NUMBER_INT);

?>

<form action="saveComment.php" method="POST">
    <p>Kirjoita kommentti</p>
    <input type="text" required maxlength="255" name="commentText" /> <br/>
    <input type="hidden" name="entryId" value="<?php print($entry_id); ?>" />
    <input type="submit" value="Tallenna" />
</form>