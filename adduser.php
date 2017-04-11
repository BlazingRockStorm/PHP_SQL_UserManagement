<?php
if(isset($_POST['adduser']))
{
$u=$p="";
 if($_POST['username'] == NULL)
 {
  echo "Vui long nhap username<br />";
 }
 else
 {
  $u=$_POST['username'];
 }
 if($_POST['password'] != $_POST['re-password'])
 {
  echo "Password va re-password khong chinh xac<br />";
 }
 else
 {
  if($_POST['password'] == NULL )
  {
   echo "Vui long nhap password<br />";
  }
  else
  {
   $p=$_POST['password'];
  }
 }
 $l=$_POST['level'];
 if($u & $p & $l){
 $conn=mysqli_connect("localhost", "gryphon", "123456","project") or die("Failed to connect to MySQL: " . mysqli_connect_error());
 $sql="select * from user where username='".$u."'";
 $query=mysqli_query($conn,$sql);
 if(mysqli_num_rows($query) != 0 ){
  echo "Username nay da ton tai roi<br />";
 }else{//bug here
  $sql2="insert into user(username,password,level) values('".$u."','".$p."','".$l."')";
  mysqli_query($conn,$sql2);
  echo "Da them thanh vien moi thanh cong";//bug end
 }
}
}
?>