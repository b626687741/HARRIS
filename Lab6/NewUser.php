<?php
session_start();
include 'Lab6Common/Header.php';
include 'Lab6Common/Functions.php';
extract($_POST);
$idError = $nameError = $phoneError = $passwordError = $repasswordError = "";
$idVal = $nameVal = $phoneVal = $passwordVal = $repassowrdVal = "";
if (isset($btnSignup) && ($_SESSION['key'] == $hiddenKey)){
    $validateSuccess = TRUE;
    // validate student id
    $idValidateSuccess = ValidateStudentId($studentId);
    if (!$idValidateSuccess){
        $idError = "Student ID cannot be blank";
        $validateSuccess = FALSE;
    }
    else {
        $idVal = $studentId;
    }
    // validate student name
    $nameValidateSuccess = ValidateStudentName($studentName);
    if (!$nameValidateSuccess) {
        $nameError = "Student name cannot be blank";
        $validateSuccess = FALSE;
    }
    else {
        $nameVal = $studentName;
    }
    
    // validate phone number
    $phoneNumberValidateSuccess = ValidatePhone($phoneNumber);
    if (!$phoneNumberValidateSuccess) {
        $phoneError = "Incorrent phone number";
        $validateSuccess = FALSE;
    }
    else {
        $phoneVal = $phoneNumber;
    }
    // validate password
    $passwordValidate = ValidatePassword($password);
    if ($passwordValidate == "blank error"){
        $passwordError = "Password cannot be blank;";
        $validateSuccess = FALSE;
    }
    else if ($passwordValidate == "length error") {
        $passwordError = "Password should be at lease 6 characters long";
        $validateSuccess = FALSE;
    }
    else if ($passwordValidate == "format error") {
        $passwordError = "Password should containt at lease one upper case, one lowercase and one digit";
        $validateSuccess = FALSE;
    }
    else {
        $passwordVal = $password;
         // compare 2 input passwords
        $repeatPasswordVlidateSuccess = ValidatePasswordMatch($password, $password2);
        if (!$repeatPasswordVlidateSuccess) {
            $repasswordError = "Password does not match";
            $validateSuccess = FALSE;
        }
        else {
            $repassowrdVal = $password2;
        }
    } 
    
    if ($validateSuccess) {
        $saveRecordSuccess = SaveStudentRecord($studentId, $studentName, $phoneNumber, $password);
        if (!$saveRecordSuccess){
            $idError = "A student with this ID has already signed up";
        }
        else {
            echo "<script>alert('Add a new student record success!')</script>";
            $idVal = $nameVal = $phoneVal = $passwordVal = $repassowrdVal = "";
            
        }
    }
}
$_SESSION['key'] = mt_rand(0, 1000000);
?>
<div class = "signup">
    <h1 class="signup-title">Sign Up</h1>
    <p style="padding-left: 70px">All fields are required</p>
    <br/>
    <form action = "NewUser.php" role="form" method="post">
        <input type="hidden" name="hiddenKey" value="<?php echo $_SESSION['key'] ?>"/>
        <div class="row horizontal-margin vertical-margin">
            <div class ="col-sm-2 label-padding highlight">Student ID:</div>
            <div class = "col-sm-2">
                <input type = "text" class = "form-control" name = "studentId" placeholder="Enter studentId" <?php echo "value = '$idVal'" ?>/>
            </div>
            <div class="error col-sm-6"><?php echo $idError ?></div>
        </div>
        <div class="row horizontal-margin vertical-margin">
            <div class ="col-sm-2 label-padding highlight">Name:</div>
            <div class = "col-sm-2">
                <input type = "text" class = "form-control" name = "studentName" placeholder="Enter student name" <?php echo "value = '$nameVal'" ?>/>
            </div>
            <div class="error col-sm-6"><?php echo $nameError ?></div>
        </div>
        <div class= "row horizontal-margin vertical-margin">
            <div class ="col-sm-2 label-padding highlight">Phone Number: <br/>(nnn-nnn-nnnn)</div>
            <div class = "col-sm-2">
                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="nnn-nnn-nnnn" <?php echo "value='$phoneVal'" ?> />
            </div>
            <div class="error col-sm-6"><?php echo "$phoneError"; ?></div>
        </div>
        <div class="row horizontal-margin vertical-margin">
            <div class ="col-sm-2 label-padding highlight">Password:</div>
            <div class = "col-sm-2">
                <input type = "password" class = "form-control" name = "password" placeholder="Confirm password" <?php echo "value = '$passwordVal'" ?>/>
            </div>
            <div class="error col-sm-6"><?php echo $passwordError ?></div>
        </div>
         <div class="row horizontal-margin vertical-margin">
            <div class ="col-sm-2 label-padding highlight">Password Again:</div>
            <div class = "col-sm-2">
                <input type = "password" class = "form-control" name = "password2" placeholder="Enter password" <?php echo "value = '$repasswordVal'" ?>/>
            </div>
            <div class="error col-sm-6"><?php echo $repasswordError ?></div>
        </div>
        <div class="row  h-margin v-margin">
            <div class="col-sm-1"><button type = "submit" name = "btnSignup" class = "btn btn-success" >Submit</button></div>
            <div class="col-sm-1"><button type ="submit" class = "btn btn-warning" name = "btnclear">Clear</button></div>
        </div>
    </form>
</div>
<?php include 'Lab6Common/Footer.php'; ?>


