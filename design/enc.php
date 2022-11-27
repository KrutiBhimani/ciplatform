<?php
$id = 123;
$salt="MY_SECRET_STUFF";
$encrypted_id = base64_encode($id . $salt);
echo $encrypted_id;
$decrypted_id_raw = base64_decode($encrypted_id);
$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
echo $decrypted_id;
?>