<?php

class Sports extends Controller{
    
    
    
    public function index(){
        // On instancie le modèle "Article"
        $this->loadModel('Sport');

        // On stocke la liste des articles dans $articles
        $sports = $this->Sport->getAll();

        // On envoie les données à la vue index
        $this->render('index', compact('sports'));
    }
    }