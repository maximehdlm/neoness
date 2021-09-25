<?php

class Activites extends Controller{
    
    // Cette méthode affiche la liste des activités
    
    public function index(){
        // On instancie le modèle "Activite"
        $this->loadModel('Activite');

        // On stocke la liste des activités dans $activites
        $activites = $this->Activite->getAll();

        // On envoie les données à la vue index
        $this->render('index', compact('activites'));
    }
}