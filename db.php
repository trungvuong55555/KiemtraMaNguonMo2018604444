<!-- author Quan dep trai -->
<?php
function exeQuery($sqlQuery,$getAll=true){
    $host="localhost";
    $dbname="dinhvanquan";
    $dbusername="root";
    $dbpassword="";
    $connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbusername,$dbpassword);
    $stmt =$connect->prepare($sqlQuery);
    $stmt->execute();
    if($getAll==true){
        return $stmt->fetchAll();
        echo"ok";
    }
    else {
        return $stmt->fetch();
        echo "notok";
    }
}
?>