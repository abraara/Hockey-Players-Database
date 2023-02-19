<?php
include("includes/mysql_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a PHP/MySQL Project that contains a hockey player database. Features include filtered searches, CRUD options, embedded youtube videos, filtered carousel options.">
    <meta name="author" content="Abraar Ahmed">
   
    <!--  This CONSTANT is defined in your mysql_connect.php file. -->
    <title><?php echo APP_NAME; ?> - Home</title>
    <!-- icon -->
    <link rel="icon" type="image/svg" href="img/favicon.svg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">



<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Google Icons: https://material.io/tools/icons/
  also, check out Font Awesome or Glyphicons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <!-- Your Custom styles for this project -->
 <!--  Note how we can use BASE_URL constant to resolve all links no matter where the file resides. -->
<link href="<?php echo BASE_URL ?>css/styles.css" rel="stylesheet">
<!-- Themes from https://bootswatch.com/ : Use the Themes dropdown to select a theme you like; copy/paste the bootstrap.css. Here, we have named the downloaded theme as a new file and can overwrite the default.  -->
<!-- <link href="<?php echo BASE_URL ?>css/bootstrap-lumen.css" rel="stylesheet"> -->
</head>
<header>
<div class="banner">

</div>
</header>
  <nav class="navbar navbar-expand-md mb-4 navbar-dark sticky-top ">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?php echo BASE_URL ?>index.php">
    <img src="img/hockey.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Hockey Players
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"> 
        <li class="nav-item">
         <a class="nav-link active" href="<?php echo BASE_URL ?>index.php">Home</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL ?>display.php">Display</a>
      </li>
          
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <li><a class="dropdown-item" href="admin/insert.php">Insert</a></li>
             <li><a class="dropdown-item" href="admin/edit-delete.php">Edit/Delete</a></li>
             <li><hr class="dropdown-divider"></li>
             <li><a class="dropdown-item" href="admin/logout.php">Login/Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    <body>
    <main role="main" class="container">

<div class="row">
<!-- main content -->
  <div class="col-sm-9">
<h1 class="fw-bolder">Home of Hockey</h1>

<p>Welcome to Hockey Players, a PHP/MySQL project that showcases a wide variety of players in the NHL. Whether you're a die-hard hockey fan or just looking to learn more about the sport and its players, Hockey Players has something for you. With comprehensive information on players from all 32 teams in the NHL, you'll be able to get to know the stars of the game and discover some up-and-coming players as well.</p>

<p>Our website features a dynamic carousel that allows you to easily navigate between western, eastern, and all star players. Simply click on the desired category and browse through our extensive list of talented athletes.</p>

<p>Our live search feature, powered by jQuery, allows you to search for players in real-time. As you type, the search results will update automatically, making it easy to find the player you're looking for all while displaying how many results are relevant to your search. You can search by name, position, or even jersey number to find the player you're looking for. Plus, with jQuery's powerful functionality, our search feature is fast, smooth, and user-friendly.</p>

<p>When a user clicks the "remember me" option in the login page, another feature that has been implemented in the project is to use cookies to store the user's credentials. This means that when the user visits the website again, their login information will be automatically filled in for them, making it more convenient for them to access their account. The cookie is set to expire after a certain amount of time, so that the user's login information is only saved for a limited amount of time.</p>

<p>Another feature of our website is that it allows users to easily parse YouTube video links without having to copy and paste only the video's ID. This makes it easy for users to quickly add YouTube videos to your website, and helps to improve the user experience by simplifying the process of adding videos. Additionally, this feature can help to ensure that the videos added to your website are always up-to-date and accurate, as it directly accesses the YouTube server to retrieve the latest version of the video.</p>

<p>Sources:</p>
<li><a href="https://www.nhl.com/" target="_blank">https://www.nhl.com/</a></li>
<li><a href="https://www.youtube.com/" target="_blank">https://www.youtube.com/</a></li>
<br>

<!-- here, we create parent div for flex -->
<div class="d-flex flex-wrap justify-content-center gap-4">

<div id="carouselExampleCaptions" class="carousel slide form-row col-md-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
</div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <a href="display.php?displayby=Conference&displayvalue=East">
      <img class="d-block" src="img/EastConference.png" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
    <h5>Eastern Conference Players</h5>
    </a>
    </div>
    </div>

    <div class="carousel-item">
    <a href="display.php?displayby=Conference&displayvalue=West">
      <img class="d-block" src="img/WestConference.png" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
    <h5>Western Conference Players</h5>
    </a>
    </div>
    </div>

    <div class="carousel-item">
    <a href="display.php?displayby=AllStar&displayvalue=1">
      <img class="d-block" src="img/AllStars.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
    <h5>All Star Players</h5>
    </a>
    </div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

  <?php
$sql = "SELECT * FROM hockey_players WHERE id = 27";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- Here we write the beginning of the while loop -->
<?php while ($row = mysqli_fetch_array($result)): ?>
  <div class="player-of-the-week">
    <div class="potw-text">
      <h3>Player of the Week</h3>
      <h4><?php echo $row['Player']?> | <a class="text-white" href="detail.php?id=<?php echo $row['id']?>">View profile</a></h4> 
    </div>
<iframe width="408" height="215"
    src="https://www.youtube.com/embed/<?php echo $row['Top_Plays']?>">
</iframe>
  </div>
<?php endwhile; ?>       

<!-- end nudge div -->
</div>

<!-- / col-9 -->
</div>

<div class="col-sm-3">

<input class="searchbar form-control mt-2" type="text" autocomplete="off" style="text-indent:17px;" placeholder="Search players by name, # or position" name="searchterm" id="searchterm">

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