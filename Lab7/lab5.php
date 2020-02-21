<?php
session_start();
define("RESTAURANT REVIEWS PATH",  "restaurant_reviews.xml");
        $restaurants = simplexml_load_file('restaurant_reviews.xml');

extract($POST);
$confirmation = false;
if (!isset($drpRestaurant) || $drpRestaurant  == -1)
{
        $drpRestaurant = -1;
        $txtAddress = "";
        $txtSummary = "";
        $drpRating = 1;
}
else {
    $rest = $restaurants->restaurant[intval($drpRestaurant)];
    if (isset($btnSave))
    {
        $rest->summary = $txtSummary;
        $rest->rating = $drpRating;
        $restaurants->asXML('restaurant_reviews.xml');
        $confirmation ="Revised Resturant has been saved";
    }
    $txtAddress = $rest->location->street . ","
            .$rest->location->city . ","
            .$rest->location->provatate . ","
            .$rest->location->postalzipcode;
    
    $txtSummary = $rest->summary;
    $drpRating = intval($rest->rating);
    
}
include './common/header.php';
?>
<div class="container">
    <div class="row vertical-margin">
        <div class="col-md-10 text-center"><h1>Online Restaurant Review</h1></div>
</div>
    <form action="lab5.php" method="post" id="restaurant-review-form">
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Restaurant:</label></div>
            <div class="col-md-6">
                <select name="drpRestaurant" id="drpRestaurant" class="form-control" onchange=""onRestaurantChange>
                    <option value="-1" <?php print ($drpRestaurant == "-1" ? "Delected" :"")?> >Select..</option>
                    <?php
                    $rests =$restaurants->restaurant;
                    for($i = 0; $i < count($restaurants->restaurant);$i++)
                    {
                        $rest = $rests[$i];
                        print "<option value='$i' ".($drprestaurant == $i ? 'Selected' :''). ">$rest->restaurant</option>";           
                    }
                     
                    ?>
                    </selected>
            </div>
            <div id="restaurant-info">
                <div class="row vertical-margin">
                    <div class="col-md-2"><label>Address:</label></div>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="2" style="width : 100%" name ="address"</textarea>
                    </div>
                </div>
            <div class="row vertical-margin">
                    <div class="col-md-2"><label>Summary:</label></div>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="2" style="width : 100%" name ="summary"</textarea>
                    </div>
                </div>
                <div class="row vertical-margin">
                    <div class="col-md-2"><label>Rating:</label></div>
                    <div class="col-md-6">
                        <select name ="$drpRating" class="form-control">
                            <?php
                            $rests =$restaurants->restaurant;
                            for($i =1; $i<= 5;$i++)
                            {
                        print "<option value='$i' ".($drpRating == $i ? 'Selected' :''). ">$i</option>";           
                            }
                            
                            
                            ?>
                        </select>
                    </div>
                </div>
            </div>
                    
                
                            <div class = "col-sm-2 album-save v-margin"><button type = "submit" name = "btnSave" class = "btn btn-primary btn-block">Save Changes</button></div>

    </form>
<?php
include './common/footer.php';
?>';