<?php
if(session_id() === ''){
    session_start();

}
include 'ProjectCommon/Header.php';

?>
<link rel="stylesheet" href="ProjectContents/Project.css">

<div class = "container">
    <h1>Welcome to Algonquian Social Media Website</h1>
    <p>If you have never used this before, you have to <a href="NewUser.php">Sign up</a> first</p>
    <p>If you have already signed up, you can <a href="Login.php">Log in</a> now</p>
</div>

<?php include 'ProjectCommon/Footer.php'; ?>
