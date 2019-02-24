<?php
// Variables
$fichier 	= fopen('resources/articles.txt', 'a');
$code_ean 	= readline("Code EAN-13 : ");

// Fonction
function parse_product($ean_code){
	if ($file = fopen("resources/produits.txt", "r")) {
    		while(!feof($file)) {
        		$line = fgets($file);
        		if (preg_match("#$ean_code#", $line)) {
				$pos_1 = strrpos($line, "['Fabriquant']");
				$str_1 = substr($line, '41', $pos_1);
				$pos_2 = strrpos($str_1, "',");
				$article = substr($str_1, '0', $pos_2);
			}
    		}
    		fclose($file);
	}
	return $article;
}

// Condition effacement liste
if ($code_ean == 'erase'){
ftruncate($fichier,0);
echo 'Contenu liste supprimé'
     ."\r\n";
}
elseif ($code_ean == 'print'){
system ("php liste-print.php");
}
// Inscription article liste
else{
$article = parse_product($code_ean);
$article_form	= "$article"
		  ."\r\n"
;
fwrite($fichier, $article_form);
echo "$article ajouté à la liste"
     ."\r\n";
}

// Fermeture fichier
fclose($fichier);

?>
