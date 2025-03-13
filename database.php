<?php
$con=mysqli_connect("localhost","root","","thesmith");
if($con){
    echo "connected";
}
else{
    echo "no";
}