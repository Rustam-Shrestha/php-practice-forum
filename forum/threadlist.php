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
        $id = $_GET['cat_id'];
        $querydisp = "SELECT * FROM `categories` WHERE cat_id=" . $id;
        $result = mysqli_query($con, $querydisp);
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<div class="jumbotron container-fluid w-100" style="width: 18rem;">
        <h1>' . $row["cat_name"] . '</h1>
        <p>' . $row["cat_description"] . '</p>
        <hr>
        <p>' . $row["created"] . '</p>
    
    </div>';
        }

        ?>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            $inserted = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // insert thred into db
                $t_head = $_POST["qhead"];
                $t_desc = $_POST["qdesc"];
                $cat_id = $_GET["cat_id"];
                $u_id = $_POST['u_id'];
                $t_insert = "INSERT INTO `threads` (`thread_subject`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `created`) VALUES ('$t_head', '$t_desc',  '$cat_id', '$u_id', current_timestamp());";
                $result_thread = mysqli_query($con, $t_insert);
                $inserted = true;
            }

            echo ($inserted) ?
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>successfully posted your concern</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
                :
                null;

            ;
        }
        ?>

    </div>

    <hr>
    <hr>

    <?php

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET["cat_id"];
        echo '
    <div class="container">
        <div class="container my-10">
            <h1>Ask a question</h1>
            // <!-- we can use  $_SERVER["self"] to represent the current url without requsts -->
            // <!-- esample gt.com/docs/abc.php?id=4 is our location that self will contain the sae address but without ?id=4-->
            // <!-- but with $_SERVER["REQUEST_URI"] we can get it all -->
            <form action="/practice/forum/threadlist.php?cat_id=' . $id . '" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Thread title</label>
                    <input type="text" class="form-control" name="qhead" aria-describedby="emailHelp"
                        placeholder="Problem Heading">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Describe your problem</label>
                    <textarea type="text" class="form-control" name="qdesc" placeholder="Problem in brief"></textarea>
                    <input type="hidden" name="u_id" value="'.$_SESSION['u_id'].'" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
        
        

    </div>';
        // }
    } else {

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>you need to signup and login to ask any questions</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    ?>

    <div class="container">
        <h1>Browse Questions</h1>
        <?php
        $id = $_GET['cat_id'];
        $querydisp = "SELECT * FROM `threads` WHERE thread_cat_id=" . $id;
        $result = mysqli_query($con, $querydisp);
        $availResult = false;
        while ($row = mysqli_fetch_assoc($result)) {
            $availResult = true;
            $th_user_id = $row["thread_user_id"];
            $id = $row['thread_id'];
            $selector = "SELECT `u_name` FROM `members` WHERE u_id='$th_user_id'";
            $mysqli_result = mysqli_query($con, $selector);
            $row_user = mysqli_fetch_assoc($mysqli_result);
            echo '
     <div class="media col">
         <div class="container media-left">
             <img src="https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg"
                 class="media-object" style="width:60px">
                 <b>' . $row_user['u_name'] . '</b>
                 <br>
                 </div>
                 <div class="media-body">
         <a href="thread.php?thread_id=' . $id . '" class="media-heading">' . $row["thread_subject"] . '</a>
         <p>' . $row["thread_desc"] . '</p>
         <sub>' . $row["created"] . '</sub>
         </div>
         <hr>
         </div>';
        }
        if (!$availResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-8">No results found</h3>
              <p class="display-8">Be the first one to leave a comment here</p>
            </div>
          </div>';
        }
        ?>
    </div>





    <?php
    require("./partials/_footer.php")
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>