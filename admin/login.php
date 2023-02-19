<?php
include("/home/aahmed98/data/data.php");
$msg = "";
    
if(isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember_me = $_POST['remember_me'];

    //setting cookies
    if($remember_me == "remember-me"){
        setcookie("username", $username, time()+3600);
        setcookie("password", $password, time()+3600);  
    }

    if(($username == $username_good) && (password_verify($password, $pw_enc))){
        // SUCCESS: User has successfully logged in. Redirect them to the secure part of the site, and record a session to be checked there. 

        session_start();
        $_SESSION['your-random-session-sjfgetwrcvdjdzzz'] = session_id();
        // redirect: remember, we must set the action of the form to REQUEST_URI
        if(isset($_GET['refer'])){
            if($_GET['refer'] == "insert"){
                header("Location:insert.php");
            }else{
                header("Location:insert.php");
            }
        }else{
            header("Location:insert.php");
        }

    }else{
        if($username != "" && $password != ""){
            $msg =  "Invalid Login";
        }else{
            $msg =  "Please enter a Username/Password";
        }

    }     
}   
    
include("admin-header.php");
?>

<!-- login form -->
<div class="body text-center">
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      <img class="mb-4 bg-dark rounded-circle p-2" src="../img/hockey.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 fw-bolder">Please sign in</h1>
      <input type="text" id="username" name="username" class="form-control" value="<?php if (isset($_COOKIE["username"])) {
          echo $_COOKIE["username"];} ?>" placeholder="Username" required="" autofocus="">
      <input type="password" id="password" name="password" class="form-control" value="<?php if (isset($_COOKIE["password"])) {
          echo $_COOKIE["password"];} ?>" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="remember_me" id="remember_me" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="submit" value="Submit" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© Abraar Ahmed 2022</p>
    </form>
</div>

<?php
if($msg != ""){
   echo "<div class=\"alert alert-info\">$msg</div>"; 
}
?>
<?php
	include("../includes/footer.php");
?>