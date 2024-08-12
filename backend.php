<?php
include("db.php");
$sql = "SELECT * FROM USERS";

try{
    mysqli_query($conn,$sql);
}
catch(mysqli_sql_exception){
    ?>
    <a href="error-404.html"></a>
    <?php
} 

?>