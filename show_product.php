<?php
$servername="localhost";
$username="root";
$password="12345678";
$dbnme="shop";
$per_page=2;
if(isset($_GET["page"])){
    $start_page=$_GET["page"]*$per_page;
}else{
    $start_page=0;
}

$conn = mysqli_connect($servername,$username,$password,$dbnme);
if(!$conn){
    die("Connect mysql database fail!!".mysqli_connect_error());
}
echo "Connect mysql successfully!";

$sql="SELECT * FROM product";
$result = mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($result);
echo "<br>".$numrow." Record<br>";
for($i=0;$i<ceil($numrow/$per_page);$i++){
    echo "<a href='show_product.php?page=$i'>[".($i+1)."]</a>";
}

$sql="SELECT * FROM product LIMIT $start_page,$per_page";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    echo "<table border=1><tr><th>id</th><th>name</th><th>description</th><th>price</th><th>pic</th></tr>";
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["description"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td><img src=".$row["pic"]."></td>";
        echo "</tr>";
        //echo "<tr><td>" $row["id"]."</td> ".$row["name"]." ".$row["description"]." ".$row["price"]." ".$row["pic"]."<br>";
    }
    echo "</table>";
}else{
    echo "0 result";
}
mysqli_close($conn);

?>
