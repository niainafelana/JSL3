<?php
//session_start();
try{
 $conn = new PDO("mysql:host=localhost;dbname=gestion_transfert",'root','');
 if(isset($_POST["btnlog"])){
    $mdp = $_POST["pass"];
    $user = $_POST["nom"];
    $sql = "SELECT username,mdp from admins where username= '$user' ";
    $info = $conn->prepare($sql);
    $info->execute();
    $info->setFetchMode(PDO::FETCH_ASSOC);
    $ro=$info->fetch();
    if(empty($ro['username'])){
       
        echo "<script>alert('verifiez votre username')</script>";
    }
    else{
        if($ro['mdp']==$mdp){
            header('location:index.php');
        }
        elseif($ro['mdp']!=$mdp){
            echo "<script>alert('verifiez votre mot de passe')</script>";
        }
    }
    }
}
catch(PDOException $e){
    echo "<script>alert('etudiant ajoute')</script>" .$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="bootstrap2/w3.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <title>Log in form</title>
</head>
<body id="gg" onload="load()">
<div id="box">
        <img src="assets/sary/impot.jpg" alt="Logo de l'EMIT" onmouseover="over(this)" onmouseout="out(this)">
        <p id="nom">SRE/HM
            <p><br>
                <button onclick="showmodal()" id="link" class="w3-button w3-blue w3-large">Login</button>
                <pre id="link"><a href=""><i class="bi bi-facebook"></i></a>    <a href=""><i class="bi bi-instagram"></i></a>    <a href=""><i class="bi bi-envelope"></i></a></pre>
                
    </div>
        <div class="w3-container">
 
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="hidemodal()" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <img src="assets/sary/impot.jpg" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="nom" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="pass" required>
          <button class="w3-button w3-block w3-blue w3-section w3-padding" type="submit"name="btnlog">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="hidemodal()" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>
  </div>
</div>
           
    </div>
    
    <footer>

    </footer>
    <script src="js/main.js"></script>
                <script src="bootstrap/js/jquery.js"></script>
                <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="node_modules/bootstrap-icons/font/bootstrap-icons.json"></script>
</body>
</html>