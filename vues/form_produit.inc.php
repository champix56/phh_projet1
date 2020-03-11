<?php 
    $linkDB = mysql_connect('127.0.0.1','root','');
    mysql_select_db('boutique',$linkDB);
    $retSQL=mysql_query('SELECT * FROM categorie WHERE 1',$linkDB);
    while($uneLigne = mysql_fetch_assoc($retSQL))
    {
        echo '<br/>';
        print_r($uneLigne);
    }

?>
<div class="form-produit">
            <form action="" method="POST" role="form">
                <legend>Edition d'un produit</legend>

                <div class="form-group">
                    <label for="">Titre du produit</label>
                    <input type="text" class="form-control" name="titre_produit" placeholder="Saisissez le titre du produit" 
                    <?php  
                        if(isset($_POST["titre_produit"]))
                        {
                            echo " value=\"".$_POST["titre_produit"]."\" "; 
                        }   
                    ?>  
                    >
                </div>
                <div class="form-group">
                    <label for="">Prix du produit</label>
                    <input type="number" min="0.01" step="0.01" class="form-control prix-produit" name="prix_produit" value="<?php
                     if(isset($_POST["prix_produit"]))
                     {
                         echo $_POST["prix_produit"]; 
                     }
                     else   echo "0.01"; 
                    ?>">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
<?php 
    mysql_close($linkDB);
?>