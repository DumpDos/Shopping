<?php
// Variables
$fichier 	= fopen('resources/produits.txt', 'a');
// Fonction recherche produit
function parse_product($ean_code){
// Initialisation variable
$article = true;
	// Condition ouverture fichier
	if ($file_1 = fopen("resources/produits.txt", "r")) {
		// Lecture fichier
    		while(!feof($file_1)) {
        		$line = fgets($file_1);
			// Recherche article
        		if (preg_match("#$ean_code#", $line)) {
				$article = false;
			}
    		}
	// Fermeture fichier
    	fclose($file_1);
	}
	// Article
	return $article;
}
// Initialisation
system ("clear");
// Inputs
echo "##################################"
     ."\r\n";
echo "# Enregistrer un nouveau produit #"
     ."\r\n";
echo "##################################"
     ."\r\n";
// Inputs
$code_ean 	= readline("Code EAN-13 	: ");
$code_nom	= readline("Nom produit		: ");
$code_fab	= readline("Nom fabriquant	: ");
// Controle BD
$article = parse_product($code_ean);
// conditions inscription BD
if ($article) {
	$article_form	= "{['EAN13']:'$code_ean', ['Article']:'$code_nom', ['Fabriquant']:'$code_fab'}"
			  ."\r\n";
	fwrite($fichier, $article_form);
	echo "$code_nom ajouté aux produits"
	     ."\r\n";
}
else {
	echo "$code_nom déjà présent dans la base de données"
	     ."\r\n";
}
// Fermeture fichier
fclose($fichier);
?>
