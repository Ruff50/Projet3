<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="bostyle.css">
  <title>MyBlogLite</title>
</head>
<body>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['desactivea'])) {
  $check = isset($_POST['desactivea']) ? "checked" : "unchecked";
    if ($check="checked") {

    $id=$_POST['postId'];
    $mysqli1 = new mysqli("localhost", "root", "", "margou");


    if ($mysqli1->connect_errno) {
        echo "Problème de connexion à la base de données !";
        exit();
    }
    $requete_sql = "UPDATE `Post` SET statut=1 where id=$id;";
    $result = $mysqli1->query($requete_sql);
    if ($result) {
      printf("<p class='success'>Article désactivé avec succès.</p><br />");
      $mysqli1->close();
    }
  }
  header('Location:BOGETALLPOST.php');
  ?>
  <?php
} else {
    ?>
<?php
  $mysqli1 = new mysqli("localhost", "root", "", "margou");


  if ($mysqli1->connect_errno) {
      echo "Problème de connexion à la base de données !";
      exit();
  }

  // Selectionner des données
  //$requete_sql = "SELECT * FROM `Post` WHERE 1 ORDER BY post_time DESC;";
 // $result = $mysqli->query($requete_sql);

  //Stocker les données
 // while ($row = $result->fetch_assoc())
 // {
 //   $post [] = $row; 
    // autre façon d'écrire
 //$post [] = [                                  
 // 'photo_avatar' => $row['photo_avatar'],
 // 'title' => $row['title'],
 // 'post-time' => $row['post-time'],
 // 'lien' => $row['lien'],
 // 'titreart' => $row['titreart'],
 // 'image_article' => $row['image_article'],
 // 'post_text' => $row['post_text'],
 // 'polike' => $row['polike'],
 // 'comments' => $row['comments'],
// ];  
//}
function getAllPost($mysqli1)
{
    // Selectionner des données

    $requete_sql = "SELECT * FROM `Post` WHERE statut=0 ORDER BY post_time DESC;";
    $result = $mysqli1->query($requete_sql);

    //Stocker les données
    while ($row = $result->fetch_assoc()) {
        $tabPosts[] = [
            'title' => $row['title'],
            'photo_avatar' => $row['photo_avatar'],
            'post_time' => $row['post_time'],
            'titreart' =>$row['titreart'],
            'image_article' => $row['image_article'],
            'post_text' => $row['post_text'],
            'polike' => $row['polike'],
            'comments' => $row['comments'],
            'ID' => $row['id'],
            'cache'=>$row['cache']
       ];
    }

    //liberer l'espace memo
    $result->free_result();
       //Fermer l'accès a la BDD
  $mysqli1->close();
    return $tabPosts;
}
function getnbPost($mysqli)
{
  $requete = "SELECT * FROM `Post` WHERE statut=0 ORDER BY post_time DESC;";
    $result = $mysqli->query($requete);
    $nbpost=$result->num_rows;   
    $result->free_result();
     return $nbpost;

}
  /*function my_var_dump($array, $name = 'var') {*/
 /*   highlight_string("<?php\n\$$name =\n" . var_export($array, true) . ";\n?>");*/
 /* }*/
  //my_var_dump($row, 'row');
  //liberer l'space memoire
 /* $result->free_result();*/

  //Fermer l'accès a la BDD
 /* $mysqli->close();*/


  // Définit le fuseau horaire par défaut à utiliser.
  date_default_timezone_set('Indian/Reunion');
//  $post1= [
//      'photo_avatar' => './images/avatar.png',
//      'title'        => 'Harry',
//      'post_time'    => 'Il y a 15 minutes',
//      'image_article'=> './images/panning-devoir.jpg',
//      'post_text'    => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium veritatis, provident officia accusantium earum aspernatur nobis beatae voluptatem veniam odio. Qui magni minus architecto libero eum ad cumque tempora quasi.',
//      'polike'         => ' 120 likes',
//      'comments'      => ' 14 Commentaires',
//  ];
//  $post2= [
//      'photo_avatar' => './images/avatar.png',
//      'title'        => 'Christophe',
//      'post_time'    =>  date("Y-m-d H:i:s"),
//      'image_article'=> '',
//      'post_text'    => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium veritatis, provident officia accusantium earum aspernatur nobis beatae voluptatem veniam odio. Qui magni minus architecto libero eum ad cumque tempora quasi.',
//      'polike'         => ' 145 likes',
//      'comments'      => ' 67 Commentaires',
//  ];
  
//  $post []=$post1;
//  $post []=$post2;
  //var_dump($post);
  $nba=getnbPost($mysqli1); 
  
?>

  <header class="topbar">
    <div class="margou">
      <div class="image">
     <img width="120px"  onmouseout="this.src='../images/margouilla.png'; " onmouseover="this.src='../images/margouilla2.png'; " src="../images/margouilla.png"/> 
    </div> 
  </div>    
      <nav class="topbar-nav">
      <a href="./BOGETALLPOST.php">Accueil</a>
      <a href="./form_post.php">Ajouter un article</a>
      <a href="#">Désactiver un article</a>
    </nav>
   
  </header>

  <div class="container">

    <div class="sidebar">
      <div class="sidebar-item"><h1>Les Margouillats de <br> Saint-Pierre</h1></div>
      </div>
    <div class="main">
    <div class="Nbart"><h2>Liste des
 <?php echo $nba?> 
     Articles</h2></div>
    <?php
if ($nba >0) {
  $post = getAllPost($mysqli1);



/*var_dump($nba);*/

for ($i=0; $i<count( $post) ; $i++) {
   
  ?>        
        <div class="post">
            
            <div class="cache">
            <?php
            if(is_null($post[$i]["cache"]) ) 
            {
              echo '<img src="'.  $post[$i]["image_article"].'" alt="post_img" class="post-img"> ';
            }  else  
            { 
                echo '<img src="'.  $post[$i]["cache"].'" alt="cache" class="cache_img"> ';
            }
           ?>     
                
          </div>

        
            <div class="info-avatar">
            <?php
            if( $post[$i]["photo_avatar"] == '../images/') 
            {
                echo '<br>' ;
            }  else 
            { 
                echo '<img src="'.  $post[$i]["photo_avatar"].'" alt="pseudo" class="avatar"> ';
            }
           ?>   
               
           
                <div class="pseudo">
                <p class="title"><?php echo  $post[$i]["title"]?></p>
                    <p class="post-time">Article publié le <?php $date= new DateTime($post[$i]["post_time"]);
                                        echo $date->format('d/m/Y \à H:i');?></p>
                </div>
                

            </div>
            <div class="TitreArt">
            <p class="titre"><?php echo  $post[$i]["titreart"]?></p>
           

            <form action="./Desactiver.php" method='POST'>
            <input type='checkbox' name='desactivea' value='on' unchecked>
            <input type="hidden" id="postId" name="postId" value="<?php echo  $post[$i]['ID']?>">
            <input type="submit" value="Désactiver"name="submit" class="bouton"> 
            </form>
            </div>
            <div class="social">
                <p class="like"><span class="icon-thumbs-up-alt"></span><?php echo ' '.  $post[$i]["polike"]?></p>
                <span></span>
                <p class="comment"><span class="icon-comment-alt"></span><?php echo ' '. $post[$i]["comments"]?></p>
            </div>
        </div>
        <?php  
    }



?>     
  <?php
  
}
else {
  echo '<p style="font-size: 36px ;"><strong>la table est vide !</strong></p>';
        exit();
} 
}
  ?>        

</div>

    </div>
  </div>
  
</body>
</html>