<?php
include("../includes/mysql_connect.php");

//search results for edit/delete page search bar
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $sql = "SELECT * from hockey_players WHERE Player LIKE '%{$input}%' OR Number LIKE '%{$input}%'
    OR Position LIKE '%{$input}%' ORDER BY Player";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);

    if(mysqli_num_rows($result) > 0){?> 
        <?php echo "<p class=\"text-center\">Search results: (" .$count. ")</p>";?>
        <div class="d-flex flex-wrap justify-content-center">
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <div class="card me-2 mb-2">
            <img src="../display/<?php echo $row['Filename']?>">
            <h3><?php echo $row['Player']?></h3>
                <div class="focus-content">
                    <p> #<?php echo $row['Number']?> | <?php echo $row['Position']?><br><?php echo $row['Team']?><br/> <a href="edit.php?edit=<?php echo $row['id']?>">Edit/Delete</a></p>
                </div>
            </div>
            <?php endwhile; ?>  
        </div>     
<?php
    }else{
        echo "<h3 class='text-danger text-center mt-3'>No results found</h3>";
    }   
}
?>