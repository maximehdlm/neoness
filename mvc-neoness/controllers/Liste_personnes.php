<?php

class Liste_personnes extends Controller{
    
    // Cette méthode affiche la liste des articles
    
    
    public function index(){

        $this->loadModel('Liste_personne');

        //require_once('./views/liste_personnes/test.php');
        $ListeSportifs = $this->Liste_personne->getAll();
    

        // On envoie les données à la vue index
        $this->render('index', compact('ListeSportifs'));
  
    }

    
    //affiche le formulaire
    public function formulaire(){
        $this->loadModel('Liste_personne');
        
        $this->render('formulaire');
   
    }

    //affiche la page d'administration
    public function administration(){
        $this->loadModel('Liste_personne');
        $liste_sportifs = $this->Liste_personne->pageAdmin();
        $this->render('administration', compact('liste_sportifs'));
   
    }

    //pour modifier et supprimer données utilisateurs depuis page admin
    public function modifAdmin(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->modifAdministration();
        $this->Liste_personne->supprAdministration();
    }

    

    //partie inscription du formulaire
    public function inscription(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->newInscription();
        
   
    }

    //partie login du formulaire
    public function login(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->connexion();
        
   
    }

    //affiche les données personnelles sur la page personnelle
    public function pagePersonnel(){
        $this->loadModel('Liste_personne');
        $liste = $this->Liste_personne->pagePerso();
        $listeActivitys = $this->Liste_personne->listeActivity();
        $listeActivitysMois = $this->Liste_personne->listeActivityMois();
        $imcGraph = $this->Liste_personne->imcGraphique();
        $this->render('pagePersonnel', compact('liste', 'listeActivitys','imcGraph', 'listeActivitysMois'));
    
   
    }

    //pour modifier son poids
    public function modifPoidsPersonnel(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->modifPoids();
    }

    //pour modifier son poids idéal
    public function modifPoidsIdealPersonnel(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->modifPoidsIdeal();
    }

    //pour modifier son mdp
    public function modifNum(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->modifNumero();
    }

    //pour modifier son mdp
    public function modifMDP(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->modifMotDePasse();
    }

    //pour rajouter les activités pratiquées
    public function sportifActivity(){
        $this->loadModel('Liste_personne');
        $this->Liste_personne->newActivity();
    }

    

    

    
}