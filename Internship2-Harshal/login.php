<?php
session_start();
?>

<html>

<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username"><br><br>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"><br><br>

    <button type="submit" name="submit">Login</button><br><br>
    
  </div>


</form>

</body>

</html>
<?php
if (isset($_POST['submit'])) {

    $conn = mysqli_connect("localhost", "root", "", "internship", "3307");
    if (!$conn) {
        echo "Can't Connnect Database" . mysqli_connect_error();
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT username,password FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);


    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {

                session_start();
                $_SESSION['user'] = $username;
                header("location: index.php");
            } else {
                header("location: login.php");
            }

        }
    } else {
        header("location: login.php");
    }

}
?>