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
    if (isset($_GET['signupsuccess']) ) {
      if($_GET['signupsuccess']=="true"){
  
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>you are signed up now log in to ask</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
      }else if($_GET['signupsuccess']==false){
  
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>User with that mail already exists</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
      }else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>server error</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          
      }
  }?>
  <?php
  require("./partials/_dbconnect.php")
    ?>
    
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img style="width:100%; height:400px;"
          src="https://media.licdn.com/dms/image/D4E12AQGjue9_rSBHAQ/article-cover_image-shrink_720_1280/0/1698112469717?e=1710374400&v=beta&t=h7vrnR-C3yTFy2zzONai-tP593lBj1cv2kZUnHmiNKo"
          class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img style="width:100%; height:400px;"
          src="https://media.licdn.com/dms/image/D4E12AQHnfKEQsc78lQ/article-cover_image-shrink_720_1280/0/1705065984190?e=1710374400&v=beta&t=X5nHL9QoMYPsnqeA_j61Rmo7JDlncqO-vXsiBJLTlGA"
          class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img style="width:100%; height:400px;"
          src="https://media.licdn.com/dms/image/D4E12AQG31PzMPWuufA/article-cover_image-shrink_720_1280/0/1705065731032?e=1710374400&v=beta&t=7DqsWuBFbj65-iCW7i7Y0p6yqIz_NPcL4nZO7O3Sf-k"
          class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- फोर लूप लगयेर कतेगोरिस हरु लै डाताबीस बाट ल्याअदै -->
  <!-- fetch all the catrgories -->

  <div class="container my-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      <?php
      $query = "SELECT * FROM `categories`";
      $result = mysqli_query($con, $query) or die("not connected " . mysqli_connect_error());
      // fetching dat in an associative array in var iable row
      while ($row = mysqli_fetch_assoc($result)) {
        $description = $row["cat_description"];

        echo '
      
        <div class="col mb-4">
          <div class="card" style="width: 18rem;">
            <img src="https://imgcdn.pakistanpoint.com/media/2020/08/_3/730x425/pic_1597660067.jpg" class="card-img-top"
              alt="...">
            <div class="card-body">
              <h5 class="card-title"> <a href="threadlist.php?cat_id=' . $row["cat_id"] . '">' . $row["cat_name"] . '</a></h5>
              <p class="card-text">' . substr($description, 0, 30) . '</p>
              <p class="card-text my-3">' . $row["created"] . '</p>
             
              </div>
          </div>
        </div>
      
    ';
      }
      ?>
    </div>
  </div>











  <?php
  require("./partials/_footer.php")
    ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>