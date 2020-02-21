<?php
session_start();
include 'ProjectCommon/Header.php';
include_once 'ProjectCommon/Functions.php';
include_once 'ProjectCommon/EntityClass.php';

if (!isset($_SESSION['loginUser'])){

    header("location: Login.php");
    exit();
}

//Page Variables
$loginUser = unserialize($_SESSION['loginUser']);
$userName = $loginUser->getName();
$userId = $loginUser->getId();
$myAlbums =  GetMyAlbum($userId);
$selectedAlbumId = NULL;
$pictures = NULL;
$selectedPictureId = NULL;
$selectedAction = NULL;
$selectedPicture = NULL;
$comments = NULL;


// get selected Album and its pictures
    if (isset($_GET['albumId'])){
        $selectedAlbumId = (int) urldecode($_GET['albumId']);
        $_SESSION['selectedAlbumId'] = $selectedAlbumId;
        $_SESSION['selectedPictureId'] = NULL;
    }
    else if (isset($_SESSION['selectedAlbumId'])){
        $selectedAlbumId = (int) $_SESSION['selectedAlbumId'];
    }
    else if($myAlbums != NULL) {
        $selectedAlbumId = $myAlbums[0]->getAlbumId();
    }
    if ($selectedAlbumId != NULL){
        $pictures = GetPicturesByAlbumId($selectedAlbumId);
    }

// get selected picutre

    if (isset($_GET['pictureId'])){
        $selectedPictureId = (int) urldecode($_GET['pictureId']);
        $_SESSION['selectedPictureId'] = $selectedPictureId;
    }
    else if (isset($_SESSION['selectedPictureId'])) {
        $selectedPictureId = $_SESSION['selectedPictureId'];
    }
    else if ($pictures != NULL) {
        $selectedPictureId =  $pictures[0]->getId();
        $_SESSION['selectedPictureId'] = $selectedPictureId;
    }
    if (isset($btnSubmit) && $_SESSION['key'] == $hiddenKey){

        if ($selectedPictureId != NULL && $commentInput != NULL){
            SaveComment($userId, $selectedPictureId, $commentInput);
        }
    }
    if ($selectedPictureId != NULL && $pictures != NULL){
        foreach ($pictures as $picture){
            if ($selectedPictureId == $picture->getId()){
                $selectedPicture = $picture;
            }
        }
    }

    if (isset($_GET["selectedAction"])) {
        $action = (string)urldecode($_GET["selectedAction"]);
        if ($action == "download") {
            downloadFile($selectedOriginalFilePath);
        } else if ($action == "delete") {
            if ($selectedPicture != NULL) {
                DeletePicture($selectedPicture);
                $_SESSION['selectedPictureId'] = NULL;
                header("location: MyPictures.php");
            }
        }
    }

    //Instantiate Variables
$selectedThumbnailName = NULL;
$selectedThumbnailPath = NULL;

    if ($selectedPicture != NULL){
        $selectedThumbnailName = $selectedPicture->getTitle();
        $selectedThumbnailPath = $selectedPicture->getAlbumFilePath();
    }
$_SESSION['key'] = mt_rand(0, 1000000);



?>
<br><br>

    <div class="container">
        <div class = "col">
            <div class = "container">
                <select id = "selectAlbum" class = "form-control" onchange = "changeAlbum()">
                    <?php
                    if ($myAlbums != NULL) {
                        foreach ($myAlbums as $myAlbum){
                            $albumId = $myAlbum->getAlbumId();
                            $albumName = $myAlbum->getTitle();
                            $updateDate = $myAlbum->getDate();
                            $optionContent = $albumName." - Updated On ".$updateDate;
                            if ($albumId == $selectedAlbumId){
                                echo "<option value = '$albumId' selected = 'selected'>$optionContent</option>";
                            }
                            else {
                                echo "<option value = '$albumId'>$optionContent</option>";
                            }

                        }
                    }
                    ?>
                </select>
            </div>
            <br>

            <div class = "capitallize"><h3><?php echo "$selectedThumbnailName" ?></h3></div>

            <div class = "container">
                <div class = "container">
                    <img class="image thumbnail" src = "<?php echo $selectedThumbnailPath."?rnd=".rand(); ?>"/>
                        <div class="middle">
                            <a  class="btn btn-primary" href="MyPictures.php?selectedAction=download"><span class="glyphicon glyphicon-download-alt"></span></a>
                            <a  class="btn btn-primary" href="MyPictures.php?selectedAction=delete"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                </div>




                <?php
            if ($pictures != NULL) {
                echo "<div class = 'img-thumbnail center-block well'>";
                for ($i = 0; $i < sizeof($pictures); $i++) {
                    $linkClass = "inselectedLink";
                    $pictureId = $pictures[$i]->getId();
                    if ( $pictureId == $selectedPictureId) {
                        $linkClass = "selectedLink";
                    }
                    $link = "MyPictures.php?pictureId=".$pictureId;
                    $imgPath =  $pictures[$i]->getThumbnailFilePath()."?rnd=".rand();
                    echo "<a href= $link class=$linkClass><img src= $imgPath></a>";
                }
                echo "</div>";
            }
            ?>

                <br>
        </div>
    </div>

        <div class = "col">
            <div class="container">
                <div class="well">
                    <p class="highlight capitallize">Description:</p>
                    <?php
                    if ($selectedPicture != NULL){
                        $description = $selectedPicture->getDescription();
                        if ($description != NULL){
                            echo "<p class='text-info'>$description</p>";
                        }
                    }
                    ?>
                    <br/>
                </div>
                <div class="well">
                <p>Comments:</p>

                </div>
            </div>
            <div class="container">
                <form action="MyPictures.php" role = "form" method="post">
                    <input type="hidden" name="hiddenKey" value="<?php echo $_SESSION['key'] ?>"/>
                    <?php
                    if ($selectedPicture != NULL){
                        print <<<MAT
                            <div class="row col-sm-12"><textarea class="form-control" name="commentInput" rows="5" placeholder="Leave Comment" ></textarea></div>
                            <div class="row col-sm-2" style="margin-top: 10px" ><button type = "submit" name = "btnSubmit" class = "btn btn-primary btn-block">Add Comment</button></div>
MAT;
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
<br><br><br><br><br>


<?php include 'ProjectCommon/Footer.php' ?>

    <script>
        function changeAlbum(){
            var albumId = $('#selectAlbum').val();
            var link = "MyPictures.php?albumId=" + albumId;
            window.location.replace(link);
        }
    </script>