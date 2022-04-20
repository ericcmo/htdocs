<?php
// The plain text password to be hashed
$plaintext_password = "Password@123";

// The hash of the password that
// can be stored in the database
$hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
// Print the generated hash
echo "Generated hash: " . $hash;

echo '<br /><br /><br /><br />';
//$hash = "$2y$10$8sA2N5Sx/1zMQv2yrTDAaOFlbGWECrrgB68axL.hBb78NhQdyAqWm";
// Verify the hash against the password entered
$verify = password_verify($plaintext_password, $hash);
// Print the result depending if they match
if ($verify) {
    echo 'Password Verified!';
} else {
    echo 'Incorrect Password!';
}
