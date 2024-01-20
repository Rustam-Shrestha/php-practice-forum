<?php
session_start();
echo '
<nav style="color:white" class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/practice/forum/">Idiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/practice/forum/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Categories
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
    </div>
    <div class="d-flex">';

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
    {
    echo '
        <form class="d-flex" role="search">
        <input class="form-control me-2 mx-8" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mx-8" type="submit">Search</button>
        </form>
        <a href="/practice/forum/partials/_logout.php" class="btn btn-primary">' . $_SESSION['u_email'] . '</a>
        ';
} else {
    echo '<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <button class="btn btn-warning mx-4" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
<button class="btn btn-warning mx-3" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>
';
}
echo '
        </div>
        </nav>
';
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

?>