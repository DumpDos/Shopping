<?php
// DumpDos 2019

// Variables
$file_0 	= fopen('resources/articles.txt', 'a');
$code_ean 	= readline("Code EAN-13 : ");

// Fonction recherche produit
function parse_product($ean_code){

// Initialisation variable
$article = 'null';

	// Condition ouverture fichier
	if ($file_1 = fopen("resources/produits.txt", "r")) {

		// Lecture fichier
    		while(!feof($file_1)) {
        		$line = fgets($file_1);

			// Recherche article
        		if (preg_match("#$ean_code#", $line)) {
				$pos_1 = strrpos($line, "['Fabriquant']");
				$str_1 = substr($line, '41', $pos_1);
				$pos_2 = strrpos($str_1, "',");
				$article = substr($str_1, '0', $pos_2);
			}
    		}

	// Fermeture fichier
    	fclose($file_1);
	}

	// Article
	return $article;
}

// Condition effacement liste
if ($code_ean == 'erase'){
	ftruncate($file_0,0);
	echo "Contenu liste supprimé"
	    ."\r\n";
}

// Condition impression liste
elseif ($code_ean == 'print'){
	system ("php liste-print.php");
}

// Inscription article liste
else{
	$article = parse_product($code_ean);

	// Condition inscription liste
	if ($article != 'null') {

		// Mise en forme
		$article_form	= "$article"
				  ."\r\n";

		// Inscription
		fwrite($file_0, $article_form);
		echo "$article ajouté à la liste"
		     ."\r\n";
	}

	// Retour info
	else {
		echo "article inconnu"
		    ."\r\n";
	}

}

// Fermeture fichier
fclose($file_0);

?>
