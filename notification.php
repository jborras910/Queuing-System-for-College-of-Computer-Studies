<?php
// Set the content type to "audio/mpeg"
header('Content-Type: audio/mpeg');

// Set the content length to the size of the audio file
header('Content-Length: ' . filesize('assets/notification.mp3'));

// Set the content disposition to "attachment" to force download
header('Content-Disposition: attachment; filename="notification.mp3"');

// Output the contents of the audio file
readfile('assets/notification.mp3');
?>
