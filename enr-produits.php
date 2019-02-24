<?php
// Variables
$fichier 	= fopen('resources/produits.txt', 'a');

// Initialisation
system ("clear");

// Inputs
echo "##################################"
     ."\r\n";
echo "# Enregistrer un nouveau produit #"
     ."\r\n";
echo "##################################"
     ."\r\n";
$code_ean 	= readline("Code EAN-13 	: ");
$code_nom	= readline("Nom produit		: ");
$code_fab	= readline("Nom fabriquant	: ");

$article_form	= "{['EAN13']:'$code_ean', ['Article']:'$code_nom', ['Fabriquant']:'$code_fab'}"
		  ."\r\n";

fwrite($fichier, $article_form);
echo "$code_nom ajouté aux produits"
     ."\r\n";


// Fermeture fichier
fclose($fichier);
?>

