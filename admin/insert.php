<?php
// SECURE SITE: here, we make sure anyone accessing has been to login first. 
session_start();
if(!isset($_SESSION['your-random-session-sjfgetwrcvdjdzzz'])){
	header("Location:login.php?refer=insert");
}
include ("admin-header.php");
?>

<?php
//setting variables
$player = "";
$age = "";
$weight = "";
$height = "";
$position = "";
$number = "";
$nationality = "";
$draft = "";
$topplays = "";
$team = "";
$conference = "";
$allstar = 0;
$active = 0;
$id = 0;
$msg = "";
$my_array['v'] = "";
$youtube = "youtube";


//if submit is clicked
if(isset($_POST['submit'])){

    $player = mysqli_real_escape_string($con, trim($_POST['player']));
	$age = mysqli_real_escape_string($con, trim($_POST['age']));
	$weight = mysqli_real_escape_string($con, trim($_POST['weight']));
	$height = mysqli_real_escape_string($con, trim($_POST['height']));
	$position = mysqli_real_escape_string($con, trim($_POST['position']));
	$number = mysqli_real_escape_string($con, trim($_POST['number']));
	$nationality = mysqli_real_escape_string($con, trim($_POST['nationality']));
	$draft = mysqli_real_escape_string($con, trim($_POST['draft']));
	$topplays = mysqli_real_escape_string($con, trim($_POST['topplays']));
    $team = mysqli_real_escape_string($con, trim($_POST['team']));
	$conference = mysqli_real_escape_string($con, trim($_POST['conference']));

    $allstar = $_POST["allstar"];
    $active = $_POST["active"];

    //we cannot grab the fileplayer from the $_POST array, but must grab it from the $_FILES array
    $filename = $_FILES['myfile']['name']; 

    $valid = 1; //assume validaion is good, any validator can veto this
    $msg = ""; // our cumaliative error mesage
    $msgPre = "<div class=\"alert alert-info\">";
	$msgPost = "</div>";

    // User val:
    if((strlen($player) < 3) || (strlen($player) > 60)){
		$valid = 0;
		$valPlayerMsg = "Please enter a player name from 3 to 60 characters.";
	}

	if($age > 120 || $age < 18){
		$valid = 0;
		$valAgeMsg = "Please enter a valid age from 18 to 120.";
	}

    if($number > 99 || $number < 0){
		$valid = 0;
		$valNumberMsg = "Please enter a valid number from 0 to 99.";
	}

    if($weight > 500 || $weight < 100){
		$valid = 0;
		$valWeightMsg = "Please enter a valid weight between 100 and 500 lbs.";
	}

    if($height > 96 || $height < 48){
		$valid = 0;
		$valHeightMsg = "Please enter a valid height between 48 and 96 inches.";
	}
    
    if ($draft > date("Y") || $draft < 1917) {
        $valid = 0;
        $valDraftMsg = "Please enter a valid draft year starting from 1917.";
    } 

    if((strlen($team) < 3) || (strlen($team) > 60)){
		$valid = 0;
		$valTeamMsg = "Please enter a team from 3 to 60 characters.";
	}

    if((strlen($topplays) < 5) || (strlen($topplays) > 255)){
		$valid = 0;
		$valTopplaysMsg = "Please enter a valid youtube video url.";
    //parsing youtube link val
	}else if(str_contains($topplays, $youtube) === false){
        $valid = 0;
        $valTopplaysMsg = "Please enter a valid youtube video url.";
    }else{
        parse_str( parse_url( $topplays, PHP_URL_QUERY ), $my_array );
        $topplays =  $my_array['v'];
    }

    if($_FILES['myfile']['type'] != "image/jpeg" && $_FILES['myfile']['type'] != "image/png"){
        $valid = 0;
        $msg .= "<p>File type is not JPEG or PNG</p>";
    }
    
    if($_FILES['myfile']['size'] > 4000000 * 1024){
        $valid = 0;
        $msg .= "<p>File is too large</p>";
    }

    //The actual upload is now moved into an if/then if the validation is good
    if($valid == 1){
        if(move_uploaded_file($_FILES['myfile']['tmp_name'], "../originals/" . $_FILES['myfile']['name'])){


            $thisFile = "../originals/" . $_FILES['myfile']['name'];

            //square copy
            if($_FILES['myfile']['type'] == "image/jpeg"){
                createSquareImageCopyjpeg($thisFile, "../thumbs/", 150);
            }
            else{
                createSquareImageCopypng($thisFile, "../thumbs/", 150);
            }

            //display copy
            if($_FILES['myfile']['type'] == "image/jpeg"){
                createThumbnailjpeg($thisFile, "../display/", 800);
            }
            else{
                createThumbnailpng($thisFile, "../display/", 800);
            }

            $sql = "INSERT into hockey_players (Player, Age, Weight, Height, Position, Team, Conference, Number, Nationality, Draft, Filename, Top_Plays, AllStar, Active)
                    Values ('$player', '$age', '$weight', '$height', '$position', '$team', '$conference', '$number', '$nationality', '$draft', '$filename', '$topplays', '$allstar', '$active')";


            mysqli_query($con, $sql) or die(mysqli_error($con));

            //resetting variables after successful upload
            $_SESSION['message'] = "Upload Successful!";
            $player = "";
            $age = "";
            $weight = "";
            $height = "";
            $position = "";
            $number = "";
            $nationality = "";
            $draft = "";
            $topplays = "";
            $team = "";
            $conference = "";
            $allstar = 0;
            $active = 0;
            $id = 0;

        }else{
            echo "<h3>ERROR</h3>";
        }
    }
}
?>
<?php
// our custom function cannot be within anyother PHP structure for jpegs
function createThumbnailjpeg($file, $folder, $newwidth){

    list($width, $height) = getimagesize($file);
    $imgRatio = $width/$height;

    $newheight = $newwidth / $imgRatio;


    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($file);

    imagecopyresampled($thumb, $source,0,0,0,0,$newwidth, $newheight, $width, $height);

    $newFileName = $folder . basename($_FILES['myfile']['name']);

    imagejpeg($thumb, $newFileName, 80); //80 is the quality of the JPEG

    imagedestroy($thumb);
    imagedestroy($source);
}
?>
<?php
// our custom function cannot be within anyother PHP structure for pngs
    function createThumbnailpng($file, $folder, $newwidth){

        list($width, $height) = getimagesize($file);
        $imgRatio = $width/$height;
    
        $newheight = $newwidth / $imgRatio;
    
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefrompng($file);
    
        imagecopyresampled($thumb, $source,0,0,0,0,$newwidth, $newheight, $width, $height);
    
        $newFileName = $folder . basename($_FILES['myfile']['name']);
    
        imagepng($thumb, $newFileName, 8); //80 is the quality of the JPEG
    
        imagedestroy($thumb);
        imagedestroy($source);  
        }
?>
<?php
//function for creating square image
    function createSquareImageCopyjpeg($file, $folder, $newWidth){
    
        $thumb_width = $newWidth;
        $thumb_height = $newWidth;// tweak this for ratio
    
        list($width, $height) = getimagesize($file);
    
        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;
    
        if($original_aspect >= $thumb_aspect) {
           // If image is wider than thumbnail (in aspect ratio sense)
           $new_height = $thumb_height;
           $new_width = $width / ($height / $thumb_height);
        } else {
           // If the thumbnail is wider than the image
           $new_width = $thumb_width;
           $new_height = $height / ($width / $thumb_width);
        }
    
        $source = imagecreatefromjpeg($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    
        // Resize and crop
        imagecopyresampled($thumb,
                           $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                           0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                           0, 0,
                           $new_width, $new_height,
                           $width, $height);
       
        $newFileName = $folder. "/" .basename($file);
        imagejpeg($thumb, $newFileName, 80);  
    }
?>
<?php
//function for creating square image
function createSquareImageCopypng($file, $folder, $newWidth){

    $thumb_width = $newWidth;
    $thumb_height = $newWidth;// tweak this for ratio

    list($width, $height) = getimagesize($file);

    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;

    if($original_aspect >= $thumb_aspect) {
       // If image is wider than thumbnail (in aspect ratio sense)
       $new_height = $thumb_height;
       $new_width = $width / ($height / $thumb_height);
    } else {
       // If the thumbnail is wider than the image
       $new_width = $thumb_width;
       $new_height = $height / ($width / $thumb_width);
    }

    $source = imagecreatefrompng($file);
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

    // Resize and crop
    imagecopyresampled($thumb,
                       $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                       0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                       0, 0,
                       $new_width, $new_height,
                       $width, $height);
   
    $newFileName = $folder. "/" .basename($file);
    imagepng($thumb, $newFileName, 8);
}

//setting error message
?>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<!-- Insert page/form -->
<h1 class="fw-bolder">Insert</h1>

<!-- Anytime you are wokring with upload, you must include the enctype attribute -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

<div class="form-group w-50">
    <label class="form-label" for="myfile">Player Picture:</label>
    <input type="file" name="myfile" class="form-control" required accept="image/png, image/jpeg">
    <?php
    if($msg){
        echo $msgPre. $msg. $msgPost;
    }
    ?>
</div>  

<div class="row">
<div class="col-md-4 mt-2">
        <label for="player" class="form-label">Player Name:</label>
        <input type="text" name="player" class="form-control" required value="<?php echo $player; ?>">
        <?php if(isset($valPlayerMsg)){echo $msgPre. $valPlayerMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="number" class="form-label">Number:</label>
        <input type="number" name="number" class="form-control" required id="number" value="<?php echo $number; ?>">
        <?php if(isset($valNumberMsg)){echo $msgPre. $valNumberMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="position" class="form-label">Position:</label>
        <select type="text" name="position" class="form-select" required id="position" value="<?php echo $position; ?>">
            <option value="" disabled selected>Choose...</option>
            <option value="LW">LW</option>
            <option value="C">C</option>
            <option value="RW">RW</option>
            <option value="D">D</option>
            <option value="G">G</option>
        </select>
    </div>
</div>

<div class="row">
<div class="col-md-4 mt-2">
        <label for="age" class="form-label">Age:</label>
        <input type="number" name="age" class="form-control" required id="age" value="<?php echo $age; ?>">
        <?php if(isset($valAgeMsg)){echo $msgPre. $valAgeMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="weight" class="form-label">Weight in lbs:</label>
        <input type="number" name="weight" class="form-control" required id="weight" value="<?php echo $weight; ?>">
        <?php if(isset($valWeightMsg)){echo $msgPre. $valWeightMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="height" class="form-label">Height in inches:</label>
        <input type="number" name="height" class="form-control" required id="height" value="<?php echo $height; ?>">
        <?php if(isset($valHeightMsg)){echo $msgPre. $valHeightMsg. $msgPost;} ?>
    </div>
</div>


<div class="row">
<div class="col-md-4 mt-2">
        <label for="draft" class="form-label">Draft Year:</label>
        <input type="number" name="draft" class="form-control" id="draft" required value="<?php echo $draft; ?>">
        <?php if(isset($valDraftMsg)){echo $msgPre. $valDraftMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="team" class="form-label">Team:</label>
        <input type="text" name="team" class="form-control" required id="team" value="<?php echo $team; ?>">
        <?php if(isset($valTeamMsg)){echo $msgPre. $valTeamMsg. $msgPost;} ?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="team" class="form-label">Conference:</label>
        <select type="text" name="conference" class="form-select" required id="conference" value="<?php echo $conference; ?>">
        <option value="" disabled selected>Choose...</option>
        <option value="East">East</option>
        <option value="West">West</option>
        </select>
    </div>  
</div>

<div class="row">
<div class="col-md-4 mt-2">
        <label for="nationality" class="form-label">Country:</label>
        <select type="text" name="nationality" class="form-select" required id="nationality" value="<?php echo $nationality; ?>">
        <option value="" disabled selected>Choose...</option>
        <option value="America">America</option>
        <option value="Canada">Canada</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Finland">Finland</option>
        <option value="Germany">Germany</option>
        <option value="Russia">Russia</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        </select>
    </div>

    <div class="col-md-4 mt-2">
        <label for="topplays" class="form-label">Top Plays Youtube Video URL:</label>
        <input type="text" name="topplays" class="form-control" id="topplays" required value="<?php echo $topplays; ?>">
        <?php if(isset($valTopplaysMsg)){echo $msgPre. $valTopplaysMsg. $msgPost;} ?>
    </div>

    <div class="d-flex justify-content-around col-md-3">
    <div class="form-check form-switch mt-4">
    <input type="hidden" id="allstar0" value="0" name="allstar"><br>
    <label for="allstar" class="form-check-label">All Star</label>
    <input class="form-check-input" type="checkbox" name="allstar" id="allstar1" value="1" checked>
    </div>

    <div class="form-check form-switch mt-4">
    <input type="hidden" id="active0" value="0" name="active"><br>
    <label for="active" class="form-check-label">Active</label>
    <input class="form-check-input" type="checkbox" name="active" id="active1" checked value="1">
    </div>
    </div>
</div>

<div class="col-12 mt-4">
        <input type="submit" class="btn btn-primary" name="submit">
    </div>

</form>

<?php
	include("../includes/footer.php");
?>