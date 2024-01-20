<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <?php
    require("./partials/_navbar.php")
        ?>
    <?php
    require("./partials/_dbconnect.php")
        ?>
    <div class="container-fluid">
        <?php
        $id = $_GET['thread_id'];
        $querydisp = "SELECT * FROM `threads` WHERE thread_id=" . $id;
        $result = mysqli_query($con, $querydisp);
        while ($row = mysqli_fetch_assoc($result)) {
            $uid = $row['thread_user_id'];
            $selector = "SELECT `u_name` FROM `members` WHERE u_id='$uid'";

            $mysqli_result = mysqli_query($con, $selector);
            $row_user = mysqli_fetch_assoc($mysqli_result);

            echo '<div class="jumbotron container-fluid w-100 bg-secondary" style="width: 18rem;">
            <h1>' . $row["thread_subject"] . '</h1>
            <p>' . $row["thread_desc"] . '</p>
            <small>posted by ' . $row_user['u_name']. '</small>
        <hr>
        <hr>
        
    
    </div>';
        }
        ?>


    </div>

    <hr>
    <hr>

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        $inserted = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // insert comment into db
            $c_ans = $_POST["qans"];
            $t_id = $_GET["thread_id"];
            $u_id = $_POST['u_id'];
            $t_insert = "INSERT INTO `comments` (`comment_desc`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$c_ans', '$t_id', '$u_id', current_timestamp());";
            $result_thread = mysqli_query($con, $t_insert);
            $inserted = true;
        }

        echo ($inserted) ?
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>comment has been added</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            :
            null;

        ;
    }
    ?>
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        echo '
    <h2>Post a comment</h2>
    <form action=' . $_SERVER["REQUEST_URI"] . ' method="POST">

        <div class="form-group">
            <label for="exampleInputPassword1">Answer the question</label>
            <textarea type="text" class="form-control" name="qans" placeholder="answer in brief"></textarea>
            <input type="hidden" name="u_id" value="' . $_SESSION['u_id'] . '" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>';
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>you need to signup and login to give any answer</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    ?>

    <h1>Discussions</h1>


    <?php
    $id = $_GET['thread_id'];
    $querydisp = "SELECT * FROM `comments` WHERE thread_id=" . $id;
    $result = mysqli_query($con, $querydisp);
    while ($row = mysqli_fetch_assoc($result)) {
        $thread_user_id = $row["comment_by"];
        $selector = "SELECT `u_name` FROM `members` WHERE u_id='$thread_user_id'";
        $mysqli_result = mysqli_query($con, $selector);
        $row_user = mysqli_fetch_assoc($mysqli_result);

        echo '<div class="jumbotron-row d-flex container-fluid w-100" style="width: 18rem;">
        <img src="https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg"
        class="media-object" style="width:60px">
        <div class="container">
        <h3 class="py-8">' . $row_user['u_name'] . '</h3>
        <p>' . $row["comment_desc"] . '</p>
        
        <sub>' . $row["comment_time"] . '</sub>
        <hr>
        </div>
        
    
    </div>';
    }
    ?>







    <?php
    require("./partials/_footer.php")
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>