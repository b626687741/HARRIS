<?php
include "Common/Picture.php";
session_start();
if ($_POST) {
    if ($_FILES) {
        $filesUploaded = false;
        $fileCount = count($_FILES['selectedUploadPictures']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $tmpFilePath = $_FILES['selectedUploadPictures']['tmp_name'][$i];
            $tmpFileName = $_FILES['selectedUploadPictures']['name'][$i];
            if ($tmpFilePath != "")
            {
                Picture::savePicture($tmpFilePath, $tmpFileName);
                $filesUploaded = true;
            }
        }
    }
}
include "Common/Header.php";
?>

<div class="container">
    <div class="row">
        <h1 class="content-center">Upload Pictures</h1>
        <p>Accepted Picture Types: JPG (JPEG), GIF and PNG</p>
        <p>You can upload multiple pictures at a time by pressing the shift key while selecting pictures</p>
    </div>

    <br />

    <div class="row">
        <p>
            <strong>File(s) to Upload:</strong>
        </p>
        <form action="UploadPicture.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="well well-sm">
                    <input type="file" id="selectedUploadPictures" name="selectedUploadPictures[]" accept=".jpg, .jpeg, .png, .gif" multiple required/ />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="formSubmitButton" name="formSubmitButton">Submit</button>
                <button type="reset" class="btn btn-primary" id="formResetButton" name="formResetButton">Clear</button>
            </div>
        </form>
    </div>
</div>

<?php include "Common/Footer.php"; ?>