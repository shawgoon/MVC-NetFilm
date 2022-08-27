<?php

class FormVerif{
    public function stripTagsArray($postArray){
        foreach ($postArray as $key => $value) {
            $postArray[$key] = strip_tags($value);
        }
        return $postArray;
    }
    public function htmlCharsArray($postArray){
        foreach ($postArray as $key => $value) {
            $postArray[$key] = htmlspecialchars($value);
        }
        return $postArray;
    }
    public function emptyField($value,$fieldName,$errors){
        if (empty($value) || $value === ""){
            $errors[$fieldName] = "Le champ $fieldName est vide!";
        } 
        return $errors;
    }
    public function verifEmail($value,$verifMail,$errors){
        if (!filter_var($value,FILTER_VALIDATE_EMAIL)){
            $errors[$verifMail] = "Le champ $verifMail n'est pas valide!";
        }
        return $errors;
    }
    public function identikPwd($value,$value2,$fieldPwd,$errors){
        if($value !== $value2){
            $errors[$fieldPwd] = "Les champ $fieldPwd ne sont pas identiques!";
        }
        return $errors;
    }
    public function verifPwd($value,$fieldPwd,$errors){
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,40}$/", $value)){
            $errors[$fieldPwd] = "Le mot de passe doit comporter une majuscule, un caractère spécial et doit comprendre au moins 8 caractères et 40 maximum!";
        }
        return $errors;
    }
    public function pwdHash($value){
        return password_hash($value,PASSWORD_ARGON2ID);
    }
}