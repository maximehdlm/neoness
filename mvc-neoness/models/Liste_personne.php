<?php
session_start();
class Liste_personne extends Model{


    public function __construct(){
        // Nous définissons la table par défaut de ce modèle
        $this->table = "liste_personnes";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

   
    
     //fonction pour l'inscription   
    public function newInscription(){    
        
        
        if (isset($_POST['inscription'])){  //Vérifie si une variable est déclarée et est différente de null
        
           
            function validate($data){  
                $data = trim($data);  // Supprime les espaces
                $data = stripslashes($data);  //Supprime les antislashs d'une chaîne
                $data = htmlspecialchars($data);  // Convertit les caractères spéciaux en entités HTML
                return $data;
            }
        
            $nom = validate($_POST['nom']);       //verifie que le champ texte de nom est bien rempli + attribution d'une variable
            $prenom = validate($_POST['prenom']);   
            $telephone = validate($_POST['telephone']);  
            $ddn = validate($_POST['ddn']);
            $stat = validate($_POST['adherent']);
            $poids = validate($_POST['poids']);
            $taille = validate($_POST['taille']);
            $objectif = validate($_POST['objectifs']);
            $mdp = validate($_POST['mdp']);
        
            
        
            //on declare une variable requete, on apelle les colonne de la table liste_personne, puis on leur insert les valeurs rentrées dans les champs input
            $requete = "INSERT INTO liste_personnes(`nom`, `prenom`, `telephone`, `date_naissance`, `statut`, `taille`, `poids`, `poids_ideal`, `mdp`) 
            VALUES('$nom', '$prenom','$telephone', '$ddn', '$stat','$taille','$poids',  '$objectif', '$mdp')";
        
        //j'apelle ma bdd et je lui attache la variable $requete
        $resultat = $this->_connexion->prepare($requete);
        $resultat->execute();
        if($resultat){      //renvoie "inscription validée si resultat est true
            echo "<script>alert('inscription validée, tu peux te connecter')</script>";
            header('refresh: 1;./formulaire');
        } else {
        
        echo 'pas bon;';
        
         }

         header("Refresh: 3; ../");
        }
    }

    //fonction pour la connexion
    public function connexion(){
       
        if (isset($_POST['connexion'])){
              
            function validate($data){  
                $data = trim($data);  // Supprime les espaces
                $data = stripslashes($data);  //Supprime les antislashs d'une chaîne
                $data = htmlspecialchars($data);  // Convertit les caractères spéciaux en entités HTML
                return $data;
            }
        
            $prenomConnect = validate($_POST['prenomConnect']);
            $mdpConnect = validate($_POST['mdpConnect']);

        
            if($prenomConnect !== "" && $mdpConnect !== ""){

                $requestAdmin = "SELECT statut FROM liste_personnes WHERE prenom = '".$prenomConnect."' and mdp = '".$mdpConnect."' ";
                $resultatConnectAdmin = $this->_connexion->prepare($requestAdmin);
                $resultatConnectAdmin->execute();
                $resultatRequestAdmin = $resultatConnectAdmin->fetch();
                $statut = $resultatRequestAdmin['statut'];

                if($statut === "Admin" || $statut === "admin"){
                    $_SESSION['prenom'] = $prenomConnect;
                    $_SESSION['mdp'] = $mdpConnect;
                    header('Location: ./administration');


                }else{
                    

                $request = "SELECT count(*) FROM liste_personnes WHERE prenom = '".$prenomConnect."' and mdp = '".$mdpConnect."' ";
                $resultatConnect = $this->_connexion->prepare($request);
                $resultatConnect->execute();
                $resultatRequest = $resultatConnect->fetch();
                $count = $resultatRequest['count(*)'];
    
        
                if($count != 0){
                    $_SESSION['prenom'] = $prenomConnect;
                    $_SESSION['mdp'] = $mdpConnect;
                    header('Location: ./pagePersonnel');

                }else{
                    echo "Votre prénom ou mot de passe est incorrect";
                }
            }
        }
                
    }
            else{
                echo "marche pas nn plus";
            }
        
        
    }

    //fonction qui affiche les données perso du sportif, ainsi que ses activités , une fois la connexion efféctuée
    public function pagePerso(){

        
        
        if($_SESSION['prenom'] !== ""){

            $personne = $_SESSION['prenom'];
            $mdp = $_SESSION['mdp'];      
            $InfoActuel = "SELECT id, poids, nom,YEAR(CURRENT_DATE) - YEAR(date_naissance), taille, poids_ideal FROM liste_personnes  WHERE prenom = '".$personne."' AND mdp = '".$mdp."'";
            $resultatConnect = $this->_connexion->prepare($InfoActuel);
            $resultatConnect->execute();
            $reponseRequete = $resultatConnect->fetch();
            return $reponseRequete;
            
            
        }
    }

    //fonction pour modifier le poids sur la page perso
    public function modifPoids(){
        
        if (isset($_POST['nvPoids'])){  //Vérifie si une variable est déclarée et est différente de null
            $personnePoids = $_SESSION['prenom'];
            $mdpPoids = $_SESSION['mdp']; 
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
        
            $poidsModif = validate($_POST['poidsModif']);
            $idTableImc = validate($_POST['idTableImc']);
            $tailleTableImc = validate($_POST['tailleTableImc']);
            $dateTableImc = validate($_POST['dateTableImc']);
            $imc = $poidsModif / (($tailleTableImc/100)*($tailleTableImc/100));
        
        //requete pour modifier le poids
        $requeteModif = "UPDATE liste_personnes SET `poids` = '".$poidsModif."' WHERE prenom = '".$personnePoids."' AND mdp = '".$mdpPoids."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){ 

        //si resultat de la requete renvoie true, alors execute la requete ci dessous, insert les données de l'utilsateur : son id, son imc et la date dans la table indice_masse_corporelle
        $requeteTableImc = "INSERT INTO indice_masse_corporelle(`numero_sportif`, `n_imc`, `date_imc`) 
        VALUES('$idTableImc', '$imc','$dateTableImc')";
        $resultatTableImc = $this->_connexion->prepare($requeteTableImc);
        $resultatTableImc->execute();   
        
            header('Location: ./pagePersonnel');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    } 
    
    
    //fonction pour modifier le poids idéal sur la page perso
    public function modifPoidsIdeal(){
        
        if (isset($_POST['nvPoidsIdeal'])){  //Vérifie si une variable est déclarée et est différente de null
            $personnePoids = $_SESSION['prenom'];
            $mdpPoids = $_SESSION['mdp']; 
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
        
            $poidsIdealModif = validate($_POST['poidsModifIdeal']);
        
        $requeteModif = "UPDATE liste_personnes SET `poids_ideal` = '".$poidsIdealModif."' WHERE prenom = '".$personnePoids."' AND mdp = '".$mdpPoids."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){     
            header('Location: ./pagePersonnel');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    }

    //fonction pour modifier le numero sur la page perso
    public function modifNumero(){
        
        if (isset($_POST['nvNum'])){  //Vérifie si une variable est déclarée et est différente de null
            $personnePoids = $_SESSION['prenom'];
            $mdpPoids = $_SESSION['mdp']; 
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
        
            $numModif = validate($_POST['modifNum']);
        
        $requeteModif = "UPDATE liste_personnes SET `telephone` = '".$numModif."' WHERE prenom = '".$personnePoids."' AND mdp = '".$mdpPoids."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){     
            header('Location: ./pagePersonnel');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    }
    
    //fonction pour modifier le mot de passe sur la page perso
    public function modifMotDePasse(){
        
        if (isset($_POST['nvMDP'])){  //Vérifie si une variable est déclarée et est différente de null
            $personne = $_SESSION['prenom'];
          
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
        
            $mdpModif = validate($_POST['modifMDP']);
            $id = validate($_POST['idMDP']);
        
        $requeteModif = "UPDATE liste_personnes SET `mdp` = '".$mdpModif."' WHERE prenom = '".$personne."' AND id = '".$id."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){     
            header('Location: ./formulaire');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    } 

     //fonction pour ajouter une activité sur la page perso   
     public function newActivity(){    
        
        
        if (isset($_POST['nouvelleActivite'])){  //Vérifie si une variable est déclarée et est différente de null
        

            function validate($data){  
                $data = trim($data);  // Supprime les espaces
                $data = stripslashes($data);  //Supprime les antislashs d'une chaîne
                $data = htmlspecialchars($data);  // Convertit les caractères spéciaux en entités HTML
                return $data;
            }
        
            $idSportif = validate($_POST['id']);
            $numActivity = validate($_POST['activite']);       //verifie que le champ texte de nom est bien rempli + attribution d'une variable
            $tempsActivity = validate($_POST['temps']);
            $dateActivity = validate($_POST['dateActivity']);   
        
            
        
            //on declare une variable requete, on apelle les colonne de la table liste_personne, puis on leur insert les valeurs rentrées dans les champs input
            $requete = "INSERT INTO activites(num_sportif, num_sport, temps, date) 
            VALUES('$idSportif', '$numActivity', '$tempsActivity', '$dateActivity')";
        
        //j'apelle ma bdd et je lui attache la variable $requete
        $resultat = $this->_connexion->prepare($requete);
        $resultat->execute();
        if($resultat){      //renvoie sur la page perso si resultat est true
            header('Location: ./pagePersonnel');
        
        } else {
        
        echo 'pas bon;';
        
         }

         header("Refresh: 3; ../");
        }
    }


    //fonction qui affiche les 7 dernieres activités sur la page perso,
    public function listeActivity(){

        
        if($_SESSION['prenom'] !== ""){

            $personne = $_SESSION['prenom'];
            $mdp = $_SESSION['mdp'];       
            $InfoActivity = "SELECT sports.nom_sport, activites.temps, activites.date, activites.num_sport FROM liste_personnes LEFT JOIN activites ON liste_personnes.id = activites.num_sportif LEFT JOIN sports ON activites.num_sport = sports.id_sport  WHERE prenom = '".$personne."' AND activites.date > DATE_SUB(NOW(), INTERVAL 7 DAY) AND mdp = '".$mdp."' ORDER BY id_activité DESC LIMIT 7";
            $resultatActivity = $this->_connexion->prepare($InfoActivity);
            $resultatActivity->execute();
            $reponseActivity =  $resultatActivity->fetchAll();
            return $reponseActivity;
            
            
            
            
        }
    }

    //fonction qui affiche les  activités pratiquées dans le mois sur la page perso,
    public function listeActivityMois(){

        
        if($_SESSION['prenom'] !== ""){

            $personne = $_SESSION['prenom'];
            $mdp = $_SESSION['mdp'];       
            $InfoActivity = "SELECT sports.nom_sport, activites.temps, activites.date, activites.num_sport FROM liste_personnes LEFT JOIN activites ON liste_personnes.id = activites.num_sportif LEFT JOIN sports ON activites.num_sport = sports.id_sport  WHERE prenom = '".$personne."' AND activites.date > DATE_SUB(NOW(), INTERVAL 30 DAY) AND mdp = '".$mdp."' ORDER BY id_activité DESC LIMIT 30";
            $resultatActivity = $this->_connexion->prepare($InfoActivity);
            $resultatActivity->execute();
            $reponseActivity =  $resultatActivity->fetchAll();
            return $reponseActivity;
            
            
            
            
        }
    }


    //fonction qui affiche l'evolution de l'imc sur la page perso,
    public function imcGraphique(){

        
        if($_SESSION['prenom'] !== ""){

            $personne = $_SESSION['prenom'];
            $mdp = $_SESSION['mdp'];       
            $sql = "SELECT DAYOFMONTH(date_imc) ,n_imc FROM indice_masse_corporelle LEFT JOIN liste_personnes ON indice_masse_corporelle.numero_sportif = liste_personnes.id WHERE prenom = '".$personne."' AND mdp = '".$mdp."' ORDER BY `date_imc` ASC ";
            $resultatActivity = $this->_connexion->prepare($sql);
            $resultatActivity->execute();
            $reponseActivity =  $resultatActivity->fetchAll();
            return $reponseActivity;
            
            
            
            
        }
    }

    //fonction pour afficher tous les utilisateurs côté admin pour modifier, supprimer 
    public function pageAdmin(){

            $InfoActuel = "SELECT *, YEAR(CURRENT_DATE) - YEAR(date_naissance) FROM liste_personnes  WHERE 1";
            $resultatConnect = $this->_connexion->prepare($InfoActuel);
            $resultatConnect->execute();
            $reponseRequete = $resultatConnect->fetchAll();
            return $reponseRequete;
            
            
        
        
    }

    //fonction pour modifier les infos des sportifs depuis la page admin
    public function modifAdministration(){
        
        if (isset($_POST['modifAdmin'])){  //bouton pour modifier données
            
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
            $id = validate($_POST['id']);
            $poidsModif = validate($_POST['modifPoids']);
            $statut = validate($_POST['modifStatut']);
        
        $requeteModif = "UPDATE liste_personnes SET `poids` = '".$poidsModif."',statut = '".$statut."' WHERE id = '".$id."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){     
            header('Location: ./administration');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    }

    //fonction pour supprimer des sportifs depuis la page admin
    public function supprAdministration(){
        
        if (isset($_POST['supprAdmin'])){  //bouton pour modifier données
            
   
            function validate($dataModif){  
                $dataModif = trim($dataModif);  // Supprime les espaces
                $dataModif = stripslashes($dataModif);  //Supprime les antislashs d'une chaîne
                $dataModif = htmlspecialchars($dataModif);  // Convertit les caractères spéciaux en entités HTML
                return $dataModif;
            }
        
            $id = validate($_POST['id']);

        //supprime les données sur la table activités
        $requeteModiftest = "DELETE FROM activites  WHERE activites.num_sportif = '".$id."'";
        $resultatModiftest = $this->_connexion->prepare($requeteModiftest);
        $resultatModiftest->execute();

        //supprime les données sur la table indice masse corporelle
        $requeteModiftest = "DELETE FROM indice_masse_corporelle  WHERE indice_masse_corporelle.numero_sportif = '".$id."'";
        $resultatModiftest = $this->_connexion->prepare($requeteModiftest);
        $resultatModiftest->execute();
     
        //supprime les données sur la table liste peronnes
        $requeteModif = "DELETE FROM liste_personnes  WHERE liste_personnes.id = '".$id."'";
        $resultatModif = $this->_connexion->prepare($requeteModif);
        $resultatModif->execute();
        if($resultatModif){     
            header('Location: ./administration');
        
        } else {
        
        echo 'pas bon;';
        
         }
        }
    }

}