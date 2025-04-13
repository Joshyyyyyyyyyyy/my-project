<?php
$conn = new mysqli('localhost', 'root', '', 'db1');
if ($conn){
    echo "Connection Succesfull";
} else {
    echo "Connection Denied!";

}
?>