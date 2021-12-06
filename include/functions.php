<?php

function categories(){
if(isset($_GET['c_id'])){
    $c_id=$_GET['c_id'];
    global $connection;
    $query="SELECT * FROM products WHERE category_id = {$c_id}";
    $cat_query = mysqli_query($connection , $query);
    while ($row=mysqli_fetch_assoc($cat_query)){
        


    }






}


}



?>