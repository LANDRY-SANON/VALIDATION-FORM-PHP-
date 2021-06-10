<?php
    require_once 'utils.php';
    $paths = get_file_paths();
    $cssfs = $paths[0];
    $jsfs = $paths[1];
    $bootstrap = "bootstrap-5.0.1-dist\\";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php foreach($cssfs as $f){
        //if(ends_with(".css", $f)){    
     ?>
    <link rel="stylesheet" href="<?php echo $bootstrap."css\\".$f ?>">
    <?php }//} ?>

    <?php 
      foreach($jsfs as $f){
        if(ends_with(".js", $f)){    
     ?>
    <script type="text/javascript" src="<?php echo $bootstrap."js\\".$f ?>"></script>
    <?php }} ?>

</head>
<style>
.error {color: #FF0000;}
</style>
<body>
<?php

 ?>
<?php require_once 'blocs/navdabr.php' ?>

<?php 
                $nomErr =$prenomErr= $emailErr =$dateErr=$fileErr="";
                $nom =$prenom=$email=$jour=$mois=$annee=  ""; 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                  if (empty($_POST["nom"])) {
                    $nomErr = "Name is required";
                  } else {
                    $nom = test_input($_POST["nom"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
                      $nomErr = "Only letters and white space allowed";
                      $nom=NULL;
                    }
                  } 
            
                  if (empty($_POST["prenom"])) {
                    $prenomErr = "prenom is required";
                  } else {
                    $prenom = test_input($_POST["prenom"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
                      $prenomErr = "Only letters and white space allowed";
                      $prenom = NULL;
                      
                    }
                  }
            
                  if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                  } else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $emailErr = "Invalid email format";
                      $email=NULL;
                    }
                  }
                  if ((($_POST["jour"]) == "--jour--") or (($_POST["mois"]) == "--mois--") or (($_POST["annee"]) == "--annee--")) {
                    $dateErr = " Date is required";}
                  else {
                    $m=$_POST["mois"];
                    $a=$_POST["annee"];
                    $j=$_POST["jour"];
                    $m_int=(date_parse_from_format(" F", $m)["month"]);
                    $date= $j."_".$m."_".$a ;
                    verifier_date((int)$j,(int)$m_int,(int)$a,$date);
                    }
                   
                  }
                  
       
                  if (($nom != NULL) and ($prenom != NULL) and ($date != NULL) ){
                    $str= $_POST['nom'].$_POST['prenom'].$_POST['mois'].$_POST['jour'].$_POST['annee'];
                    $ID= sha1($str);
                    $etudiants = array(
                      $ID => $_POST ) ;
                      file_put_contents('donnees.json', json_encode($etudiants),FILE_APPEND);
                      afficher($_POST);
                
                    }
                    
                   
                  ?>
          <div class="container">
            <div class="row">
              <div class="col-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque assumenda necessitatibus accusamus, ipsum autem similique quasi, rerum omnis dignissimos error molestiae, ut magni ea. Quod vitae id sint provident qui.
              </div>

              <div class="col-6">
                <h1>Formulaire d'inscription d'un nouveau étudiant</h1>
                <form class="row g-6" method="post" action="" enctype="multipart/form-data">
                
                  <div class="col-md-6">

                    <label for="firstname1" class="form-label" >Nom</label>
                    <input type="text" class="form-control" id="firstname1" name="nom">
                    <span class="error">* <?php echo $nomErr;?></span>
                  </div>
                  <div class="col-md-6">

                    <label for="lastname1" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="lastname1" name="prenom" >
                    <span class="error">* <?php echo $prenomErr;?></span>
                  </div>
                  <div class="col-md-12">

                    <label for="#" class="form-label col-md-4">Date de naissance</label>

                    <select id="jrns" class="form-select col-md-4" name="jour">
                    <option selected> --jour--</Option>
                      <?php for($i=1; $i<=31; $i++){ ?>
                        <option><?php echo $i ?></option>
                      <?php } ?>
                    </select>

                    <select id="msns" class="form-select col-md-4" name="mois" >
                    <option selected> --mois--</Option>
                      <?php for($i=1; $i<=12; $i++){  ?>
                        <option><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                      <?php } ?> 
                    </select>

                    <select id="anns" class="form-select col-md-4" name="annee">
                     <option selected> --annee--</Option> 
                      <?php for($i=1950; $i<=(2018); $i++){ ?>
                        <option><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    <span class="error">* <?php echo $dateErr;?></span>
                  </div>
                 
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                    <span class="error">* <?php echo $emailErr;?></span>
                  </div>

                  <div class="mb-3">
                    <label for="formFile" class="form-label">Entrer votre photo d'identité</label>
                    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                    
                  </div>

                  <div class="col-6">
                    
                  <button type="reset" class="btn btn-primary" value="Effacer"> Effacer </button> <button type="submit" class="btn btn-primary" name="submit" value="ok">Envoyer</button>
                    
                  </div>
                
                </form>
              </div>
            </div>
          </div>
  </body>
</html>