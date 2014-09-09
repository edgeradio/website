<?php

$message = "test";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
mail('my987fm@gmail.com', 'My Subject', $message);

?>