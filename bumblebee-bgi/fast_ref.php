<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

$servername = "localhost";
$username = "root";
$password = "chocolate";
$dbname = "cocoa_bgi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// The length we want the unique reference number to be
$flagship_fast_ref_length = 8;

// A true/false variable that lets us know if we've
// found a unique reference number or not
$flagship_fast_ref_found = false;

// Define possible characters.
$possible_fast_chars = "23456789BCDFGHJKMNPQRSTVWXYZ";

// Until we find a unique reference, keep generating new ones
while (!$flagship_fast_ref_found) {

    // Start with a blank reference number
    $flagship_fast_ref = "";

    // Set up a counter to keep track of how many characters have
    // currently been added
    $i = 0;

    // Add random characters from $possible_chars to $unique_ref
    // until $unique_ref_length is reached
    while ($i < $flagship_fast_ref_length) {
        // Pick a random character from the $possible_chars list
        $char = substr($possible_fast_chars, mt_rand(0, strlen($possible_fast_chars)-1), 1);
        $flagship_fast_ref .= $char;
        $i++;
    }

    // Our new unique reference number is generated.
    // Lets check if it exists or not
    $fast_query = "SELECT `ref_no_sys` FROM `bgi_reservations` 
                  WHERE `fast_ref_no_sys`='BGI-" . $flagship_fast_ref . "'";
    $result = $conn->query($fast_query);
    if ($result->num_rows==0) {
        // We've found a unique number. Lets set the $unique_ref_found
        // variable to true and exit the while loop
        $flagship_fast_ref_found = true;
    }
}
$conn->close();
?>