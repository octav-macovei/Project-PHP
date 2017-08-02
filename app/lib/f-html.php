<?php

/**
 * @author My Name <my.name@example.com>
 * 
 * O functie ce returneaza un tag html
 * 
 * @param string $tag Numele tagului.
 * 
 * @param string $attr Lista cu atributele tagului.
 * 
 * @param string $content Continutul tagului
 * 
 * @param bool $singular Tipul tagului, pereche sau singular.
 * 
 * @return string Codul html pentru acest tag.
 * 
 */
function write_tag($tag, $attr='', $content='', $singular=false){
    $s = "<$tag";
    
    if ($attr){
        $s .= ' '.$attr;
    }
    
    if ($content){ 
        $s .= ">\n$content\n</$tag>\n";
    } else {
        // in aceasta ramura avem 2 cazuri
        // 1. tag singular, fara continut
        // 2. tag pereche dar fara continut
        if ($singular){
            $s .= " />\n";
        } else {
            $s .= ">\n</$tag>\n";    
        }
    }
    return $s; // este preferat sa folosim return si sa facem echo write_tag(), astfel avem ocazia cand apelam functia sa punem rezultatul intr-o variabila
}

/**
 * @author My Name <my.name@example.com>
 * 
 * O functie ce returneaza un tag html
 * 
 * @param string $lang Limba paginii.
 * 
 * @param string $head_content Lista cu taguri ce apar intre tagurile head, link ,meta, etc.
 * 
 * 
 * @return string Codul html pentru acest tag.
 * 
 */
function html_start($lang = 'ro', $title = 'Titlul paginii', $head_content = ''){

    $html = '<!DOCTYPE html>

    <html lang="'.$lang.'">
    
    <head>
    <meta charset="utf-8" />
    <title>'.$title.'</title>'."\n".
        $head_content
    ."\n</head>"."\n".'<body>'."\n";

    return $html;


} /// html_start()


/**
 * @author My Name <my.name@example.com>
 * 
 * O functie ce returneaza tagurile de inchidere a unei paginii html
 * 
 * @return string Codul html pentru acest tag.
 * 
 */
function html_end(){

    return "\n</body>\n</html>";

} // html_end()


/**
 * @author My Name <my.name@example.com>
 * 
 * O functie ce returneaza codul html pentru un tabel
 * 
 * @param array $arr Un array bidimesional, ale carui vaolri vor fi afisate in tabel.
 *              Array-ul poate arata asa:
 *              $arr = array (
 *                  array('nume' => 'Mihai', 'varsta' => 23, 'sex' => 'm'),
 *                  array('nume' => 'Ioana', 'varsta' => 45, 'sex' => 'f'),
 *                  array('nume' => 'Ion', 'varsta' => 22, 'sex' => 'm'),
 *                  array('nume' => 'Maria', 'varsta' => 22, 'sex' => 'f')
 *                );
 * $param bool $header Daca este true tabelul va avea cheile pe post de header
 * 
 * @return string Codul html pentru acest tag.
 * 
 */
function write_table($arr, $header=false){

    $rez = '<table border="1">'."\n";    
    
    if ($arr && $header) {
        array_unshift($arr, array_keys(current($arr)));
    }

    foreach ($arr as $key=>$val){   
       // write table rows 
        $rez .= "\n".'<tr>'."\n";

        foreach ($val as $v){
            $rez .='<td>'.$v.'</td>';
        }

        $rez .="\n".'</tr>'."\n"; 
        // end table rows
    }

    $rez .='</table>';

    return $rez;
    
} // write_table($nume_array)


