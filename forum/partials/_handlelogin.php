<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    include "_dbconnect.php";
    $email = $_POST["lgemail"];
    $password = $_POST["lgpwd"];
    $find = "SELECT * FROM members WHERE u_email='$email'";
    $result = mysqli_query($con, $find);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $rows = mysqli_fetch_assoc($result);
        if (password_verify($password, $rows["u_password"])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["u_email"] = $rows["u_email"];
            $_SESSION["u_id"] = $rows["u_id"];
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>' . $email . ' logged in</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>';
            header("Location: /practice/forum/index.php");
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>incorrect credentials fed</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          header("Location: /practice/forum");
        }
    }
}

?>