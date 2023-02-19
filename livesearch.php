<?php

include("includes/mysql_connect.php");

//search results for sidebar searchbar
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $sql = "SELECT * from hockey_players WHERE Player LIKE '%{$input}%' OR Number LIKE '%{$input}%'
    OR Position LIKE '%{$input}%' ORDER BY Player";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);

    if(mysqli_num_rows($result) > 0){?> 
        <!-- Here we write the beginning of the while loop -->
        <?php while ($row = mysqli_fetch_array($result)): ?>
            <a class="search-items" href="detail.php?id=<?php echo $row['id']?>"><div class="d-flex"><img src="thumbs/<?php echo $row['Filename']?>">
            <div class="d-md-block">
            <h4 class="mx-2 mt-2"><?php echo $row['Player']?></h4>
            <p class="fs-6 fw-lighter d-inline ms-2"> #<?php echo $row['Number']?> | <?php echo $row['Position']?></p>
            </div>            
        </div></a>
        <?php endwhile; 
        echo "<p class=\"text-center\">Search results: (" .$count. ") </p>";?>       

<?php
    }else{

        echo "<h6 class='text-danger text-center mt-3'>No results found</h6>";
    }
}

?>