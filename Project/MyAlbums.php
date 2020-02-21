<?php
session_start();
include 'ProjectCommon/Header.php';
include_once 'ProjectCommon/Functions.php';

$_SESSION['attemptAccessPage'] = 'MyAlbums.php';
if (!isset($_SESSION['loginUser'])){
    
    header("location: Login.php");
    exit();
}


$loginUser = unserialize($_SESSION['loginUser']);
$userName = $loginUser->getName();
$userId = $loginUser->getId();
$myAlbums =  GetMyAlbum($userId);



if(isset($_GET['deleteId'])){
    $deleteId = $_GET["deleteId"];
    $albumId = (int) urldecode($deleteId);
    DeleteAlbum($albumId, $userId);
    header("location:MyAlbums.php");
    exit();
}

extract($_POST);
if (isset($btnSaveChange)){
    for ($i = 0; $i < sizeof($myAlbums); $i++){
        $albumId = $myAlbums[$i]->getAlbumId();
        $code = $myAlbums[$i]->getCode();
        $name = "accessbility".$albumId;
        
        if ($_POST[$name] != $code){
            UpdateAccessbilityCode($albumId, $_POST[$name]);
            
            header("location:MyAlbums.php");
            exit();
        }
    }
    
}

for($i = 0; $i < sizeof($myAlbums); $i++){
    $albumId = $myAlbums[$i]->getAlbumId();
    $numberOfPictures = getNumberOfPicturesForAlbum($albumId);
    $myAlbums[$i]->setPictureNumbers($numberOfPictures);
}
$accessibility = getAccessCodeFromAccessibility();
?>
<div class = "container">
    <link rel="stylesheet" href="ProjectContents/Project.css">
    <h1 class="center v-margin">My Albums</h1>
    <p>Welcome <mark><?php echo "$userName" ?>!</mark> (not you? change user <a href="Login.php">here</a>)</p>
    <div class = "col-sm-2"><a  class = "btn btn-primary" href="AddAlbum.php">Create a New Album</a></div>
    <br>

    <form action="MyAlbums.php" role="form" method="post">
        <div class="table table-striped">
              <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="col-md-3">Title</th><th scope="col" class="col-md-1">Date Updated</th><th scope="col" class="col-md-1">Number of Pictures</th><th scope="col" class="col-md-2">Accessibility</th><th scope="col" class="col-md-1"></th>
                    </tr>
                </thead>
                <?php 
                for($i = 0; $i < sizeof($myAlbums); $i++) {
                    $id = $myAlbums[$i]->getAlbumId();
                    $title = $myAlbums[$i]->getTitle();
                    $date = $myAlbums[$i]->getDate();
                    $picturesNumber = $myAlbums[$i]->getNumberOfPictures();
                    $accessCode = $myAlbums[$i]->getCode();
                    $selectItem = $accessCode == "private"? 0:1;
                    $deleteLink = "MyAlbums.php?deleteId=".$id;
                    $pictureLink = 'MyPictures.php?albumId='.$id;
                    $name = "accessbility".$id;
                    echo "<tr>";
                    echo "<td><a class=\"btn btn-default btn-sm\" href='$pictureLink'>$title</a></td><td>$date</td><td>$picturesNumber</td>";
                    echo "<td><select class = 'form-control' name = '$name'>";
                    for($j = 0; $j < sizeof($accessibility); $j++){
                        $accessibilityCode = $accessibility[$j]->getCode();
                        $accessibilityDescription = $accessibility[$j]->getDescription();
                        if ($accessibilityCode == $accessCode) {
                            echo "<option value = '$accessibilityCode' selected = 'selected'>$accessibilityDescription</option>";
                        }
                        else {
                            echo "<option value = '$accessibilityCode'>$accessibilityDescription</option>";
                        }
                    }

                    echo "</select></td>";
                    echo "<td><a class=\"btn btn-default btn-sm\"href='$deleteLink'>delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
       
  
    <div class = "col-sm-2 album-save v-margin"><button type = "submit" name = "btnSaveChange" class = "btn btn-primary btn-block">Save Changes</button></div>
</form>
</div>
<?php include 'ProjectCommon/Footer.php' ?>

<script>
0
</script>
