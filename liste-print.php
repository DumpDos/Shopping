<?php

require '/root/vendor/mike42/escpos-php/autoload.php';
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
$connector = new NetworkPrintConnector("192.168.0.30", 9100);
$printer = new Printer($connector);

function strtouppernoaccent($var)
{
                $search         = 'çñÄÂÀÁäâàáËÊÈÉéèëêÏÎÌÍïîìíÖÔÒÓöôòóÜÛÙÚüûùúµ';
                $replace        = 'cnaaaaaaaeeeeeeeeeiiiiiiiioooooooouuuuuuuuu';
                return strtr(strtoupper(replaceAllAccents($var)), $search, $replace);
}

function replaceAllAccents($string) {
    $new_string = str_replace(
        array(
            'à', 'â', 'ä', 'á', 'ã', 'å',
            'î', 'ï', 'ì', 'í',
            'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
            'ù', 'û', 'ü', 'ú',
            'é', 'è', 'ê', 'ë',
            'ç', 'ÿ', 'ñ',
            'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
            'Î', 'Ï', 'Ì', 'Í',
            'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø',
            'Ù', 'Û', 'Ü', 'Ú',
            'É', 'È', 'Ê', 'Ë',
            'Ç', 'Ÿ', 'Ñ',
        ),
        array(
            'a', 'a', 'a', 'a', 'a', 'a',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'e', 'e', 'e', 'e',
            'c', 'y', 'n',
            'A', 'A', 'A', 'A', 'A', 'A',
            'I', 'I', 'I', 'I',
            'O', 'O', 'O', 'O', 'O', 'O',
            'U', 'U', 'U', 'U',
            'E', 'E', 'E', 'E',
            'C', 'Y', 'N',
        ),
        $string);
     
    return $new_string;
}

function Contenuliste($file_list) {
	$file    = fopen( $file_list, "r" );
	$content = "";
	while(!feof($file)) {
	 $content .= fgets($file, 255);
	}
	fclose($file);   
    return $content;
}

$date_str_0 = date('d/m/Y à H:i');
$list_str_0 = Contenuliste("resources/articles.txt");

// Most simple example
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> feed(10);
title($printer, "Liste de Couses\n");

$printer -> feed(10);
$printer -> setTextSize(2, 2);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("$list_str_0\n");
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setTextSize(1, 1);
$printer -> feed(10);
$printer -> text("Ticket émis le $date_str_0");
$printer -> feed(5);
$printer -> setTextSize(1, 1);


// Cut & close
$printer -> cut();
$printer -> close();

function title(Printer $printer, $str)
{
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
    $printer -> text($str);
    $printer -> selectPrintMode();
}

?>
