<?php

#echo password_hash('password', PASSWORD_BCRYPT, array('cost' => 12));
$stored_password = '$2y$12$lxvB1NIGKFlMcZ9AusfVG.A3Yf8bKg1RCLxbYRy8ye5Z89fNGGgsC';

if(password_verify('password', $stored_password)){
	echo "you are in!";
} else{
	echo "try again";
}
