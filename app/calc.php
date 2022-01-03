<?php

$date = date("Y");

function calcAge($DateNaiss , $DateDonnee){
    $age = substr($DateDonnee, 0, 4) - substr($DateNaiss, 0, 4); 
     
    if ( substr($DateDonnee, 4, 4) < substr($DateNaiss, 4, 4) ) 
    { 
    $age--; 
    }  
    return $age; 
}

function calcImc($height, $weight) {
    $x = $height/100;
    $imc = $weight / ($x * $x);
    return round($imc, 2);
}

// Pour la femme : (10 × Poids en kg) + (6,25 x Taille en cm) - (5 × âge en années) - 161
// Pour l’homme : (10 x Poids en kg) + (6,25 x Taille en cm) - (5 x âge en années) + 5

// Pour compléter votre analyse de besoin il suffit de calculer le besoin calorique total selon votre niveau d’activité comme suivant :
// Métabolisme de base x1,2 = Sédentaire, pas d’activité physique
// Métabolisme de base x1,55 = Personne active / Exercices d’intensité modérée 3 à 5 fois par semaine / Marche 2 à 5 km par jour / Fait entre 9400 pas et 23 500 pas.
// Métabolisme de base x1,725 = Personne très active / Exercices de forte intensité 6 fois par semaine / Marche plus de 5 km par jour / Fait plus de 23 500 pas.
function calckal($gender, $weight, $height, $age) {
    $kal = (10 * $weight) + (6.25 * $height) - (5 * $age);
    if ($gender == 0) {
        $kal -= 161;
    } elseif ($gender == 1) {
        $kal += 5;
    }
    return $kal;
}


