<?php 
//print_r($_POST);

    $linkDB = mysqli_connect('127.0.0.1','root','','boutique');
    
    $id=(isset($_GET["id"]))? $_GET["id"] : NULL ;

    if(isset($_POST["titre_produit"]) && !isset($_GET["id"]))
    {
           $requete="INSERT INTO `produit`( `titre`, `description`, `prix`, `idcat`) VALUES ('".$_POST["titre_produit"]."' ,'".$_POST["description_produit"]."' ,".$_POST["prix_produit"].",".$_POST["idcat"].")";
          // echo $requete;
          $retInsertSQL=mysqli_query($linkDB,$requete);
          if($retInsertSQL!=NULL){
            //echo 'c\'est OK';
            header("Location:index.php");
            exit();
        }
    } 
    else if(isset($_GET["id"])&& strlen( $_GET["id"])>0){
       
      $requete =  "SELECT `idp`, `titre`, `description`, `dimensions`, `poids`, `rating`, `ean`, `prix`, `idcat` FROM `produit` WHERE idp=".$_GET["id"];
       $retProduitSQL = mysqli_query($linkDB,$requete);
       $ligneProduit=mysqli_fetch_assoc($retProduitSQL);
       
        if(isset($_POST["titre_produit"])  ){
            echo '<h1>Update </h1>';
        }
    }

?>
<div class="form-produit">
            <form action="" method="POST" role="form">
                <input type="text" name="id_produit" <?php  
                        if(isset($ligneProduit))
                        {
                            echo " value=\"".$ligneProduit["idp"]."\" "; 
                        }
                        // if(isset($_POST["id_produit"]))
                        // {
                        //     echo " value=\"".$_POST["id_produit"]."\" "; 
                        // }
                    ?> >
                <legend>Edition d'un produit</legend>

                <div class="form-group">
                    <label for="">Titre du produit</label>
                    <input type="text" class="form-control" name="titre_produit" placeholder="Saisissez le titre du produit" 
                    <?php  
                     if(isset($ligneProduit))
                     {
                         echo " value=\"".$ligneProduit["titre"]."\" "; 
                     }
                        // if(isset($_POST["titre_produit"]))
                        // {
                        //     echo " value=\"".$_POST["titre_produit"]."\" "; 
                        // }   
                    ?>>
                </div>
                <div class="form-group">
                        <select name="idcat" >
                            <option value="NULL">Sans categorie</option>
                            <?php 
                            $retSQL=mysqli_query($linkDB,'SELECT * FROM categorie WHERE 1');
                            while($uneLigne = mysqli_fetch_assoc($retSQL))
                            {
                                echo '<option value="'.$uneLigne['idcat'].'" ';
                                if(isset($ligneProduit) && $ligneProduit['idcat']!=NULL)
                        {
                            echo "selected=\"selected\" "; 
                        }
                               
                                // if(isset($_POST["idcat"])  && $_POST['idcat'] == $uneLigne['idcat'] )
                                // {
                                //     echo 'selected="selected" ';
                                // }                                    
                                echo '>'.$uneLigne['nom'].'</option>';
                            } 
                            mysqli_free_result($retSQL);
                            ?>
                        </select>
                        <br/>
                    <label for="prix_produit">Prix du produit</label>
                    <input type="number" min="0.01" step="0.01" class="form-control prix-produit" name="prix_produit" value="<?php
                    if(isset($ligneProduit))
                    {
                        echo $ligneProduit["prix"]; 
                    }
                    //  if(isset($_POST["prix_produit"]))
                    //  {
                    //      echo $_POST["prix_produit"]; 
                    //  }
                     else   echo "0.01"; 
                    ?>">
                    <label >
                     image du produit<br/>
                        <input type="file" name="image_produit" />
                    </label>
                    <br/>
                    <label >
                     Description du produit<br/>
                     <textarea name="description_produit"  cols="30" rows="10"><?php 
                         if(isset($ligneProduit))
                         {
                             echo $ligneProduit["description"]; 
                         }
                        //  if(isset($_POST["description_produit"]))
                        // {
                        //         echo $_POST["description_produit"];
                        // }
                         ?></textarea>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
<?php 
    mysqli_close($linkDB);
?>