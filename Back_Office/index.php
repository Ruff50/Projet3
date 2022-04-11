<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connex.css">
    <title>MyBlogLite</title>
</head>
<body>
<?php

$mysqli = new mysqli("localhost", "root", "", "margou");

if($mysqli->connect_errno){
    echo "Problème de connexion à la base données !";
    exit();

}

$requete_sql = "SELECT * FROM `Password`;";
$result = $mysqli->query($requete_sql);

while ($row = $result->fetch_assoc())
{
    $post [] = $row;
}

$result->free_result();

$mysqli->close();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(($_POST['Login'] == '') && ($_POST['mdp'] == '')){
        
        printf('<p class="rien">Veuillez compléter tous les champs...</p><br />');
    }

        else{
            $pseudo_saisi = htmlspecialchars($_POST['Login']);
            $mdp_saisi = htmlspecialchars($_POST['mdp']);

            for ($i=0; $i<count( $post) ; $i++){

                if ($post[$i]["Login"] == $pseudo_saisi){
                    if($post[$i]["Mdp"] == $mdp_saisi){
        
                        header('Location:BOGETALLPOST.php');
        
                }else{
                    echo "<p>Votre mot de passe ou pseudo est incorrect</p>";
        
            }
        }
        }
        }


        //$pseudo_par_default = "admin";
        //$mdp_par_default = "admin1234";
    


}
?>

    <section>
        <div class="form-container">
            <h1>MyBlogLite <br> Connexion</h1>
            <form action="./index.php" class='submit-post' method="POST"> 
                <div class="control">
                    <label for="name">Name</label>
                    <input type="text" name="Login" id="name">
                </div>
                <div class="control">
                    <label for="psw">Password</label>
                    <input type="password" name="mdp" id="psw">
                </div>
                <div class="control">
                    <input type="submit" id="bouton" value="login">
                </div>
            </form>
        </div>
    </section>
</body>
</html>