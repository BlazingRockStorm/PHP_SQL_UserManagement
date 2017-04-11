<?php
if(isset($_POST['ok'])){
 $u=$p="";
 
 //check username was enter or not
 if($_POST['username'] == NULL){
  echo "Please enter your username<br />";
 }else{
  $u=$_POST['username'];
 }
 
 //check password was enter or not
 if($_POST['password'] == NULL){
  echo "Please enter your password<br />";
 }else{
  $p=$_POST['password'];
 }
 
 if($u && $p){
  $conn=mysqli_connect("localhost", "gryphon", "123456","project") or die("Failed to connect to MySQL: " . mysqli_connect_error());
  $sql="select * from user where username='".$u."' and password='".$p."'";
  $query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query) == 0){//wrong input of password or username
   echo "Username or password is not correct, please try again";
  }else{
   $row=mysqli_fetch_array($query);
   session_start();
   $_SESSION['userid']=$row['id'];
   $_SESSION['level']=$row['level'];
   if(isset($_SESSION['userid']) && $_SESSION['level'] == 2){
       ?>
       <table width='400' border='1'>
        <tr>
            <td>STT</td>
            <td>Username</td>
            <td>Level</td>
            <td>Edit</td>
            <td>Del</td>
        </tr>
       
<?php
   $sql="select * from user order by id DESC";
  $query=mysqli_query($conn,$sql);
  //check if there are noone in the list
  if(mysqli_num_rows($query) == 0){
    echo "<tr><td colspan=5 align=center>Chua co username nao</td></tr>";
  }else{
      $stt=0;
    while($row=mysqli_fetch_array($query)){
      $stt++;
      echo "<tr>";
      echo "<td>$stt</td>";
      echo "<td>$row[username]</td>";
      if($row['level'] == "1"){
        echo "<td>Member</td>";
      }else{
        echo "<td>Admin</td>";
      }
      echo "<td><a href='edit_user.php?userid=$row[id]'>Edit</a></td>";
      echo "<td><a href='del_user.php?userid=$row[id]'>Del</a></td>";
      echo "</tr>";
    }
  }
?>
       </table>
       <br><a href="addUser.html" align="center"><button>Add user</button></a>
       <?php
    }else{
        header("location: login.php");
        exit();
    }
  }
 }
}
