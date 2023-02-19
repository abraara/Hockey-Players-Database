<?php
// SECURE SITE: here, we make sure anyone accessing has been to login first. 
session_start();
if(!isset($_SESSION['your-random-session-sjfgetwrcvdjdzzz'])){
	header("Location:login.php?refer=insert");
}
include ("admin-header.php");

//pagination
$getcount = mysqli_query ($con,"SELECT COUNT(*) FROM hockey_players");
$postnum = mysqli_result($getcount,0);
$limit = 14;
if($postnum > $limit){
$tagend = round($postnum % $limit,0);
$splits = round(($postnum
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
//MySQLi upgrade: we need this for mysql_result() equivalent
function mysqli_result($res, $row, $field=0) {
	$res->data_seek($row);
	$datarow = $res->fetch_array();
	return $datarow[$field];
}
?>

<div class="row">
	<div class="col-sm-5">
	<h1 class="fw-bolder">Choose Player to Edit/Delete</h1>
	<input class="searchbar form-control mb-2 mt-4" style="text-indent:25px;" type="text" autocomplete="off" placeholder="Search player by name, # or position" name="searchterm" id="searchterm">

	<!--jQuery for live search -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#searchterm").keyup(function(){

		var input = $(this).val();

		if(input == ""){
			$('#searchresults').html("");
			$("#searchresults").cc("display","hidden");
		return;  //return is to abort the operation
		}else{
			$.ajax({
			url:"adminsearchedit.php",
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

		<!-- edit/delete thumbpics -->
		<div class="thumbpics-edit">
		<?php $result = mysqli_query($con, "SELECT * FROM hockey_players ORDER BY Player $limstring"); ?>
		<?php while ($row = mysqli_fetch_array($result)){ ?>
			<a class="p-1" href="edit.php?edit=<?php echo $row['id']; ?>">
			<img class="rounded-top" src="../thumbs/<?php echo $row['Filename']?>">
			<p><?php echo $row['Player']; ?></p>
			</a>
		<?php } ?> 
		</div>
		<div class="pagination mt-4 justify-content-center">
		<?php
		//pagination links
			if($postnum > $limit){
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
	</div>
	<!-- live search results -->
	<div class="col-sm-7" id="searchresults"></div>

</div>
<?php
include("../includes/footer.php");
?>