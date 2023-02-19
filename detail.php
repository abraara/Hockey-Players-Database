<?php include ("includes/header.php");
$id = $_GET['id'];
if(!is_numeric($id)){
    header("Location:index.php");// must happen before any browser output.
}
?>
<div class="display row">
  <!-- display screen -->
<div class="display-pics col-sm-9 d-flex flex-wrap justify-content-center">
<?php $result = mysqli_query($con, "SELECT * FROM hockey_players where id = '$id'")  or die(mysqli_error($con)); ?>
<!-- Here we write the beginning of the while loop -->
<?php while ($row = mysqli_fetch_array($result)): ?>

<div class="display-visuals col-sm-8 justify-content-center">
  <img src="display/<?php echo $row['Filename']?>">
  <iframe width="830" height="400"
    src="https://www.youtube.com/embed/<?php echo $row['Top_Plays']?>">
</iframe>
</div>
<div class="display-desc text-center col-sm-4 mt-3 ps-1">
  <h2><b><?php echo $row['Player']?> | #<?php echo $row['Number']?></b></h2>
  <h4><b>Position: </b><?php echo $row['Position']?></h4>
  <h4><b>Age: </b><?php echo $row['Age']?></h4>
  <h4><b>Weight: </b><?php echo $row['Weight']?> lbs</h4>
  <h4><b>Height: </b><?php echo $row['Height']?>"</h4>
  <h4><b>Year Drafted: </b><?php echo $row['Draft']?></h4>
  <h4><b>Team: </b><?php echo $row['Team']?></h4>
  <h4><b>Conference: </b><?php echo $row['Conference']?>ern Conference</h4>
  <h4><b>Country: </b><?php echo $row['Nationality']?></h4>
  <h4><b>All-Star: </b><?php  if ($row['AllStar'] == 1){ echo $row['AllStar'] = "Yes"; }else{ echo $row['AllStar'] = "No";}?></h4>
  <h4><b class="d-flex justify-content-center">Playing Status:&nbsp;<?php if ($row['Active'] == 1){ echo $row['Active'] = "<h4 style=\"color:#00FF00;font-weight:bold;\">Active</h4>"; }else{ echo $row['Active'] = "<h4 style=\"color:red;font-weight:bold;\">Inactive</h4>";}?></b></h4>
</div>

<?php endwhile; ?>       
</div>

<div class="sidebar col-sm-3">
<input class="searchbar form-control mt-4" type="text" autocomplete="off" style="text-indent:17px;" placeholder="Search players by name, # or position" name="searchterm" id="searchterm">

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
<?php
	include("includes/footer.php");
?>