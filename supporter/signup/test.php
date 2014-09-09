<?php 

$username='lol';
$email='lol@lol.com';

$message = "A new supporter has signed up. Please get in contact with this person about the 10 Edge Approved CDs they want.\nName: $username\nEmail: $email";

$message = wordwrap($message, 70);

// Send
mail('my987fm@gmail.com', 'ATTN: NEW EDGE SUPPORTER', $message);
?>