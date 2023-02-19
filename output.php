<?php include ("includes/header.php"); ?>

<!-- thumbnail pics  -->
<div class="thumb-pics">
        
<?php $result = mysqli_query($con, "SELECT * FROM hockey_players ORDER BY id"); ?>

<!-- Here we write the beginning of the while loop -->
<?php while ($row = mysqli_fetch_array($result)): ?>

<p><img src="thumbs/<?php echo $row['Filename']?>"><br><a href="detail.php?id=<?php echo $row['id']?>"><?php echo $row['Player']?></a></p> 

<?php endwhile; ?>       
</div>
 

<?php
	include("includes/footer.php");
?>