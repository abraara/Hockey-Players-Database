<?php include ("includes/header.php"); ?>

<?php 
//setting variables
$displayby = "";
$displayvalue = "";
$min = "";
$max = "";

if(isset($_GET['displayby'])){
	$displayby = $_GET['displayby'];
}
if(isset($_GET['displayvalue'])){
	$displayvalue = $_GET['displayvalue'];
}
if(isset($_GET['min'])){
	$min = $_GET['min'];
}
if(isset($_GET['max'])){
	$max = $_GET['max'];
}

//pagination
$getcount = mysqli_query ($con,"SELECT * FROM hockey_players");
$count = mysqli_num_rows($getcount);
$limit = 16;
if($count > $limit){
$tagend = round($count % $limit,0);
$splits = round(($count
-
$tagend)/$limit,0);
if($tagend == 0){
	$num_pages = $splits;
}else{
	$num_pages = $splits + 1;
}
if(isset($_GET['pg'])){
	$pg = $_GET['pg'];
}else{
	$pg = 1;
}

$startpos = ($pg*$limit)-$limit;
$limstring = "LIMIT $startpos,$limit";
}else{
$limstring = "LIMIT 0,$limit";
}

//validation
if($displayby && $displayvalue){
	$sql = "SELECT * FROM hockey_players WHERE $displayby LIKE '%$displayvalue%' ORDER BY Player $limstring ";
  $countnum = mysqli_query($con, "SELECT * FROM hockey_players WHERE $displayby LIKE '%$displayvalue%' ORDER BY Player") or die(mysqli_error($con));

}else{
  $sql = "SELECT * FROM hockey_players ORDER BY Player $limstring";
  $countnum = mysqli_query($con, "SELECT * FROM hockey_players ORDER BY Player") or die(mysqli_error($con));

}
if($displayby == "Weight" || $displayby == "Age"){
  $min = $_GET['min'];
  $max = $_GET['max'];
  $sql = "SELECT * FROM hockey_players WHERE $displayby BETWEEN '$min' AND '$max' $limstring";
  $countnum = mysqli_query($con, "SELECT * FROM hockey_players WHERE $displayby BETWEEN '$min' AND '$max'") or die(mysqli_error($con));
}

?>
<!-- page setup -->
<div class="row">
  <div class="col-sm-9">

  <!-- page title -->
  <h1 class="mb-3 d-flex"><b>Hockey Players</b>
    <div class="fst-italic">
<?php 
  if($displayby != "Active" && $displayby != "AllStar" && $displayvalue){
    echo "- $displayby: $displayvalue"; 
  }else if($displayby == "AllStar"){
    echo "- All Stars";  
  }else if($displayby == "Weight"){
    if($max == "500"){
      echo "- $displayby: $min lbs +"; 
    }else
    {
      echo "- $displayby: $min lbs to $max lbs"; 
    }
  }else if($displayby == "Age"){
    if($max == "120"){
      echo "- $displayby: $min years old +"; 
    }else
    {
      echo "- $displayby: $min years old to $max years old"; 
    }
  }else{
    echo "- All"; 
  }
?>
</div>
</h1>
<?php

  //query for results
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));

?>

<!-- here, we create parent div for flex -->
<div class="d-flex flex-wrap justify-content-center">
  
<!-- Here we write the beginning of the while loop -->
<?php while ($row = mysqli_fetch_array($result)): ?>
  <div class="card me-2 mb-2">
  <img src="display/<?php echo $row['Filename']?>">
<h3><?php echo $row['Player']?></h3>
<div class="focus-content">
    <p> #<?php echo $row['Number']?> | <?php echo $row['Position']?><br><?php echo $row['Team']?><br/> <a href="detail.php?id=<?php echo $row['id']?>">View profile</a>
    </p>
  </div>
  </div>
<?php endwhile; ?>       

<!-- end nudge div -->
</div>
	
	<!-- / col-9 -->
</div>

<div class="col-sm-3">

<input class="searchbar form-control mt-2" type="text" autocomplete="off" placeholder="Search players by name, # or position" name="searchterm" id="searchterm" style="text-indent:17px;">

<!-- live search results -->
<div id="searchresults"></div>

<!--jQuery for live search -->
<script type="text/javascript">
  $(document).ready(function(){

    $("#searchterm").keyup(function(){

      var input = $(this).val();

      if(input == ""){
         $('#searchresults').html("");
    return;  //return is to abort the operation
      }else{
        $.ajax({
          url:"livesearch.php",
          method:"POST",
          data:{input:input},

          success:function(data){
            $("#searchresults").html(data);
            $("#searchresults").cc("display","block");
          }
        });
      }
    });
  });
</script>

<!-- sidebar links -->
<div class="side-links text-center mt-3">
<h2 class="pt-2">Nationality</h2>
<a href="display.php?displayby=Nationality&displayvalue=America">America</a> | 
<a href="display.php?displayby=Nationality&displayvalue=Canada">Canada</a> | 
<a href="display.php?displayby=Nationality&displayvalue=Czech%20Republic">Czech Republic</a> |
<a href="display.php?displayby=Nationality&displayvalue=Finland">Finland</a> |
<a href="display.php?displayby=Nationality&displayvalue=Germany">Germany</a> | 
<a href="display.php?displayby=Nationality&displayvalue=Russia">Russia</a> | 
<a href="display.php?displayby=Nationality&displayvalue=Slovakia">Slovakia</a> |  
<a href="display.php?displayby=Nationality&displayvalue=Sweden">Sweden</a> | 
<a href="display.php?displayby=Nationality&displayvalue=Switzerland">Switzerland</a>

<h2 class="pt-2">Age</h2>
<a href="display.php?displayby=Age&min=18&max=24">Age: 18 years old - 24 years old</a><br>
<a href="display.php?displayby=Age&min=25&max=34">Age: 25 years old - 34 years old</a><br>
<a href="display.php?displayby=Age&min=35&max=44">Age: 35 years old - 44 years old</a><br>
<a href="display.php?displayby=Age&min=45&max=120">Age: 45 years old +</a> 

<h2 class="pt-2">Weight</h2>
<a href="display.php?displayby=Weight&min=150&max=179">Weight: 150 lbs - 179 lbs</a><br>
<a href="display.php?displayby=Weight&min=180&max=209">Weight: 180 lbs - 209 lbs</a><br>
<a href="display.php?displayby=Weight&min=210&max=239">Weight: 210 lbs - 239 lbs</a><br>
<a href="display.php?displayby=Weight&min=240&max=500">Weight: 240 lbs +</a>

<h2 class="pt-2">Position</h2>
<a href="display.php?displayby=Position&displayvalue=LW">LW</a> | 
<a href="display.php?displayby=Position&displayvalue=C">C</a> | 
<a href="display.php?displayby=Position&displayvalue=RW">RW</a> | 
<a href="display.php?displayby=Position&displayvalue=D">D</a> | 
<a href="display.php?displayby=Position&displayvalue=G">G</a> 

<!-- sidebar widget -->
<div class="hockey-sidebar">
<div class="widgetheading">
    All Socials <br><div style="font-weight:300;">Check out more from the NHL</div>
</div>
<div class="share-sidebar">
  <a class="icon-snapchat social-icon" href="https://www.snapchat.com/add/nhl" target="_blank" rel="noopener">
  <i class="fa fa-snapchat-ghost fa-2x"></i></a>
  <a class="icon-twitter social-icon" href="https://twitter.com/NHL" target="_blank" rel="noopener">
  <i class="fa fa-twitter fa-2x"></i></a>
  <a class="icon-instagram social-icon" href="https://www.instagram.com/nhl/?hl=en" target="_blank" rel="noopener">
  <i class="fa fa-instagram fa-2x"></i></a>
  <a class="icon-facebook social-icon" href="https://www.facebook.com/NHL/" target="_blank" rel="noopener">
  <i class="fa fa-facebook fa-2x"></i></a>
  <a class="icon-youtube social-icon" href="https://www.youtube.com/NHL" target="_blank" rel="noopener">
  <i class="fa fa-youtube fa-2x"></i></a>
  <a class="icon-linkedin social-icon" href="https://www.linkedin.com/company/national-hockey-league" target="_blank" rel="noopener">
  <i class="fa fa-linkedin fa-2x"></i></a>
  <a class="icon-pinterest social-icon" href="https://www.pinterest.ca/NHL/" target="_blank" rel="noopener">
  <i class="fa fa-pinterest-p fa-2x"></i></a>
</div>
</div>
<div style="clear: both;"></div>

</div>
</div>
</div>
<div class="pagination justify-content-center mt-5">
<?php
//pagination links
if($displayby && $displayvalue){
  $count = mysqli_num_rows($countnum);
  if($count > $limit){
    $tagend = round($count % $limit,0);
    $splits = round(($count
    -
    $tagend)/$limit,0);
    if($tagend == 0){
      $num_pages = $splits;
    }else{
      $num_pages = $splits + 1;
    }
    if(isset($_GET['pg'])){
      $pg = $_GET['pg'];
    }else{
      $pg = 1;
    }
    $n = $pg + 1;
    $p = $pg - 1;
    $thisroot = $_SERVER['PHP_SELF'];
    if($pg > 1){
      echo "<a class=\"page-link rounded-start px-lg-5\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$p\"><< prev</a>";
    }else{
      echo "<li class=\"page-item disabled\">";
      echo "<a class=\"page-link rounded-start px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$p\"><< prev</a>";
      echo "</li>";
    }
    for($i=1; $i<=$num_pages; $i++){
    if($i!= $pg){
      echo "<a class=\"page-link\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$i\">$i</a>";
    }else{
      echo "<a class=\"page-link bg-primary text-white\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$i\">$i</a>";
    }
    }
    if($pg < $num_pages){
      echo "<a class=\"page-link rounded-end px-lg-5\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$n\">next >></a>";
    }else{
      echo "<li class=\"page-item disabled\">";
      echo "<a class=\"page-link rounded-start px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\" href=\"$thisroot?displayby=$displayby&displayvalue=$displayvalue&pg=$n\">next >></a>";
      echo "</li>";
    }
}
}else if($min && $max){
  $count = mysqli_num_rows($countnum);
  if($count > $limit){
    $tagend = round($count % $limit,0);
    $splits = round(($count
    -
    $tagend)/$limit,0);
    if($tagend == 0){
      $num_pages = $splits;
    }else{
      $num_pages = $splits + 1;
    }
    if(isset($_GET['pg'])){
      $pg = $_GET['pg'];
    }else{
      $pg = 1;
    }
    $n = $pg + 1;
    $p = $pg - 1;
  $thisroot = $_SERVER['PHP_SELF'];
  if($pg > 1){
    echo "<a class=\"page-link rounded-start px-lg-5\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$p\"><< prev</a>";
  }else{
    echo "<li class=\"page-item disabled\">";
    echo "<a class=\"page-link rounded-start px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$p\"><< prev</a>";
    echo "</li>";
  }
  for($i=1; $i<=$num_pages; $i++){
  if($i!= $pg){
    echo "<a class=\"page-link\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$i\">$i</a>";
  }else{
    echo "<a class=\"page-link bg-primary text-white\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$i\">$i</a>";
  }
  }
  if($pg < $num_pages){
    echo "<a class=\"page-link rounded-end px-lg-5\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$n\">next >></a>";
  }else{
    echo "<li class=\"page-item disabled\">";
    echo "<a class=\"page-link rounded-start px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\" href=\"$thisroot?displayby=$displayby&min=$min&max=$max&pg=$n\">next >></a>";
    echo "</li>";
  }

}
}else{
  $n = $pg + 1;
  $p = $pg - 1;
  $thisroot = $_SERVER['PHP_SELF']; 
  if($pg > 1){
    echo "<a class=\"page-link rounded-start px-lg-5\" href=\"$thisroot?pg=$p\"><< prev</a>";
  }else{
    echo "<li class=\"page-item disabled\">";
    echo "<a class=\"page-link rounded-start px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\" href=\"$thisroot?pg=$p\"><< prev</a>";
    echo "</li>";
  }
  for($i=1; $i<=$num_pages; $i++){
  if($i!= $pg){
    echo "<a class=\"page-link\" href=\"$thisroot?pg=$i\">$i</a>";
  }else{
    echo "<a class=\"page-link bg-primary text-white\" href=\"$thisroot?pg=$i\">$i</a>";        
  }
  }
  if($pg < $num_pages){
    echo "<a class=\"page-link rounded-end px-lg-5\" href=\"$thisroot?pg=$n\">next >></a>";
  }else{
    echo "<li class=\"page-item disabled\">";
    echo "<a class=\"page-link rounded-end px-lg-5\" tabindex=\"-1\" aria-disabled=\"true\"  href=\"$thisroot?pg=$n\">next >></a>";
    echo "</li>";
  }		
}
?>
</div>
 
<?php
	include("includes/footer.php");
?>