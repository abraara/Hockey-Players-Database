<?php
session_start();
if(!isset($_SESSION['your-random-session-sjfgetwrcvdjdzzz'])){
	header("Location:login.php?refer=insert");
}
?>
<?php
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
$active = "";
$id = 0;
$msg = ""; 
$my_array['v'] = "";
$youtube = "youtube";
$update = false;

//edit feature
if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con, "SELECT COUNT(*) FROM hockey_players WHERE id=$id");
        $postnum = mysqli_result($record,0);

		if ($postnum == 0 ) {
			$n = mysqli_fetch_array($record);
			$player = $n['Player'];
            $age = $n['Age'];
            $weight = $n['Weight'];
            $height = $n['Height'];
            $position = $n['Position'];
            $team = $n['Team'];
            $conference = $n['Conference'];
            $number = $n['Number'];
            $nationality = $n['Nationality'];
            $draft = $n['Draft'];
            $topplays = $n['Top_Plays'];
            $allstar = $n['AllStar'];
            $active = $n['Active'];
		}
	}
    function mysqli_result($res, $row, $field=0) {
        $res->data_seek($row);
        $datarow = $res->fetch_array();
        return $datarow[$field];
    }
    
//if update is clicked
if (isset($_POST['update'])) {
    $id = $_POST['id'];
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

    $valid = 1; //assume validaion is good, any validator can veto this
    $msg = ""; // our cumaliative error mesage
    $msgPre = "<div class=\"alert alert-info\">";
    $msgPost = "</div>";

    // User val:
    if ((strlen($player) < 3) || (strlen($player) > 60)) {
        $valid = 0;
        $valPlayerMsg = "Please enter a player name from 3 to 60 characters.";
    }

    if ($age > 120 || $age < 18) {
        $valid = 0;
        $valAgeMsg = "Please enter a valid age from 18 to 120.";
    }

    if ($number > 99 || $number < 0) {
        $valid = 0;
        $valNumberMsg = "Please enter a valid number from 0 to 99.";
    }

    if ($weight > 500 || $weight < 100) {
        $valid = 0;
        $valWeightMsg = "Please enter a valid weight between 100 and 500 lbs.";
    }

    if ($height > 96 || $height < 48) {
        $valid = 0;
        $valHeightMsg = "Please enter a valid height between 48 and 96 inches.";
    }

    if ($draft > date("Y") || $draft < 1917) {
        $valid = 0;
        $valDraftMsg = "Please enter a valid draft year starting from 1917.";
    }

    if ((strlen($team) < 3) || (strlen($team) > 60)) {
        $valid = 0;
        $valTeamMsg = "Please enter a team from 3 to 60 characters.";
    }

    if ((strlen($topplays) < 5) || (strlen($topplays) > 255)) {
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

    if ($valid == 1) {

        mysqli_query($con, "UPDATE hockey_players SET Player='$player', Age='$age', Weight='$weight', Height='$height', Position='$position', Number='$number', Nationality='$nationality', Conference='$conference', Draft='$draft', Top_Plays='$topplays', Team='$team', AllStar='$allstar', Active='$active' WHERE id=$id");
        header('Location:insert.php');
        $_SESSION['message'] = "File updated!";
    }
        
}
//if delete is clicked
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    header('Location:insert.php');
    mysqli_query($con, "DELETE FROM hockey_players WHERE id=$id");
    
    $_SESSION['message'] = "File deleted!";
}
?>
<!-- edit form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id;?>">
<?php
        $result = mysqli_query($con, "SELECT * FROM hockey_players where id = '$id'")  or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result)): 
            echo "<h1 class=\"fw-bolder\">Edit/Delete</h1>";?>

        <h3><?php echo $row['Player']?></h3>
        <img class="rounded w-25" src="../display/<?php echo $row['Filename']?>"><br><br>

<div class="row">
    <div class="col-md-4">
        <label class="form-label" for="player">Player Name:</label>
        <input type="text" name="player" class="form-control" required value="<?php echo $row['Player'] ?>">
<?php if(isset($valPlayerMsg)){echo $msgPre. $valPlayerMsg. $msgPost;}?>
    </div>

    <div class="col-md-4">
        <label for="number" class="form-label">Number:</label>
        <input type="number" name="number" class="form-control" required id="number" value="<?php echo $row['Number'] ?>">
<?php if(isset($valNumberMsg)){echo $msgPre. $valNumberMsg. $msgPost;}?>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="position">Position:</label>
        <select type="text" name="position" class="form-select" id="position">
        <option hidden value="<?php echo $row['Position']?>" selected="selected"><?php echo $row['Position']?></option>
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
        <input type="number" name="age" class="form-control" required id="age" value="<?php echo $row['Age'] ?>">
<?php if(isset($valAgeMsg)){echo $msgPre. $valAgeMsg. $msgPost;}?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="weight" class="form-label">Weight in lbs:</label>
        <input type="number" name="weight" class="form-control" required id="weight" value="<?php echo $row['Weight'] ?>">
<?php if(isset($valWeightMsg)){echo $msgPre. $valWeightMsg. $msgPost;}?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="height" class="form-label">Height in inches:</label>
        <input type="number" name="height" class="form-control" required id="height" value="<?php echo $row['Height'] ?>">
<?php if(isset($valHeightMsg)){echo $msgPre. $valHeightMsg. $msgPost;}?>
    </div>
</div>
    
<div class="row">
    <div class="col-md-4 mt-2">
        <label for="draft" class="form-label">Draft Year:</label>
        <input type="number" name="draft" class="form-control" id="draft" required value="<?php echo $row['Draft'] ?>">
<?php if(isset($valDraftMsg)){echo $msgPre. $valDraftMsg. $msgPost;}?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="team" class="form-label">Team:</label>
        <input type="text" name="team" class="form-control" required id="team" value="<?php echo $row['Team']?>">
<?php if(isset($valTeamMsg)){echo $msgPre. $valTeamMsg. $msgPost;}?>
    </div>

    <div class="col-md-4 mt-2">
        <label for="team" class="form-label">Conference:</label>
        <select type="text" name="conference" class="form-select" required id="conference">
        <option hidden value="<?php echo $row['Conference'] ?>" selected="selected"><?php echo $row['Conference'] ?></option>
        <option value="East">East</option>
        <option value="West">West</option>
        </select>
    </div>
</div>
   
<div class="row">
    <div class="col-md-4 mt-2">
        <label for="nationality" class="form-label">Country:</label>
        <select type="text" name="nationality" class="form-select" required id="nationality">
        <option hidden value="<?php echo $row['Nationality'] ?>" selected="selected"><?php echo $row['Nationality'] ?></option>
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
        <input type="text" name="topplays" class="form-control" id="topplays" required value="https://www.youtube.com/watch?v=<?php echo $row['Top_Plays'] ?>">
<?php if(isset($valTopplaysMsg)){echo $msgPre. $valTopplaysMsg. $msgPost;}?>
    </div>

    <div class="d-flex justify-content-around col-md-3">
    <div class="form-check form-switch mt-3">
    <input type="hidden" id="allstar0" value="0" name="allstar" <?php if ($row['AllStar'] == 0) {echo "checked";} ?>><br>
    <label for="allstar" class="form-check-label">All Star</label>
    <input class="form-check-input" type="checkbox" name="allstar" id="allstar1" value="1" <?php if ($row['AllStar'] == 1) {echo "checked";} ?>>
    </div>

    <div class="form-check form-switch mt-3">
    <input type="hidden" id="active0" value="0" name="active" <?php if ($row['Active'] == 0) {echo "checked";} ?>><br>
    <label for="active" class="form-check-label">Active</label>
    <input class="form-check-input" type="checkbox" name="active" id="active1" value="1" <?php if ($row['Active'] == 1) {echo "checked";} ?>>
    </div>
    </div>
</div>

    <input type="hidden"name="myfile" class="form-control">
    
    <div class="col-12 mt-4">
    <button class="btn btn-primary" type="submit" name="update">Update</button>
    <a href="edit.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
    </div>
    </form>

<?php endwhile;?> 
<?php
	include("../includes/footer.php");
?>