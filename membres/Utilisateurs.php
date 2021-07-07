<?php

class Utilisateurs
{
    private $erreurs = [],
        $id,
        $nom,
        $prenom,
        $tel,
        $mel;

    const NOM_INVALID = 1;
    const PRENOM_INVALID = 2;
    const MEL_INVALID = 3;
    public function __construct($donnees = []){
        if(!empty($donnees)){
            $this->hydrater($donnees);
        }

    }

    public function hydrater($donnees){
        foreach($donnees as $attribut => $valeur){
            $methodeSetter = 'set'.ucfirst($attribut);
            $this->$methodeSetter($valeur);
        }
    }
    //Setters
    public function setId($id){
        if (!empty($id)){
            $this->id = (int) $id;
        }
    }
    public function setNom($nom){
        if (!is_string($nom)|| empty($nom)){
            $this->erreurs[] = self::NOM_INVALID;
        }else{
            $this->nom = $nom;
        }
    }
    public function setPrenom($prenom){
        if (!is_string($prenom)|| empty($prenom)){
            $this->erreurs[] = self::PRENOM_INVALID;
        }else{
            $this->prenom = $prenom;
        }
    }
    public function setTel($tel){
        if (!empty($tel)){
            $this->tel = $tel;
        }
    }
    public function setMel($mel){
        if(filter_var($mel, FILTER_VALIDATE_EMAIL)){
            $this->mel = $mel;
        }else{
            $this->erreurs[] = self::MEL_INVALID;
        }
    }
    //Getters
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getTel(){
        return $this->tel;
    }
    public function getMel(){
        return $this->mel;
    }
    public function getErreurs(){
        return $this->erreurs;
    }
    public function isUserValide(){
        return !(empty($this->nom) || empty($this->prenom) || empty($this->mel));
    }
}