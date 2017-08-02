<?php

namespace classes;

class Formular{

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag form
     * 
     * @param string $method Metoda formularului, implicit este get.
     * 
     * @param string $action Fisierul care prelucreaza formularul.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag, 
     *                      de exemplu $params = 'style="color:red"' adauga un stil inline tagului.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function start_form($method = 'get', $action = '', $params = '')
    {
            $html = '
            <form method="'.$method.'" action="'.$action.'" '.$params.'>			
            '."\n";		

            return $html;
    }


    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tagul pereche de inchidere a unui tag form
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function end_form()
    {
            $html = '</form>'."\n";
            return $html;
    }

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag label.
     * 
     * @param string $value Continutul tagului.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag, 
     *                       de exemplu $params = 'style="color:red"' adauga un stil inline tagului.
     * 
     * @param string $for Valoarea atributului for pentru tagul label.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function addLabel($value, $for='', $params = '')
    {
        if ($for){
            $rez = '<label for="'.$for.'"';
        } else {
            $rez =  '<label';
        }

        if ($params){
            $rez .= ' '.$params.'>'.$value.'</label>';
        } else {
            $rez .= '>'.$value.'</label>';
        }

        return $rez;
    }

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag input de tip text, email, etc.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $type Valoarea atributului type care implicit este text.
     * 
     * @param string $elementData Valoarea atributului value, implicit este stringul vid.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag, 
     *                       de exemplu $params = 'style="color:red"' adauga un stil inline tagului.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_input($name, $type = 'text', $elementData = '', $params = '')
    {
            $field = '<input type="'.$type .'" id ="'.$name.'" name="'.$name.'"';

            $elementData = trim($elementData); // curatam $elementData

            $field .= ' value="'.$elementData.'" '; // il adaugam tagului

            if ($params != '') $field .= ' ' . $params;

            $field .= ' />';

            return $field;
    } // end form_input

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag input de tip password.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $elementData Valoarea atributului value, implicit este stringul vid.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_pass($name, $elementData = '', $params = '') 
    {
            // parola nu se retine pentru o eventuala reafisare
            $field = $this->form_input($name, 'password', '', $params);

            return $field;
    } // end form_pass


    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag input de tip checkbox.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $value Valoarea atributului value.
     * 
     * @param array $elementData Un array ce contine valorile atributelor value
     *                              din tagurile input de checkbox grupate sub aceeasi valoare a atributului name
     *                              care sunt selectate.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_ck($name, $value, $elementData = '', $params = '')
    {
            $checked = false;

            if (is_array($elementData) && in_array($value, $elementData))
                    $checked = true;

            if ($checked)
                    $ck_str = ' checked = "checked" ';
            else
                    $ck_str = '';

            $field = '<input type="checkbox" id="'.$value.'" name="'.$name.'[]" value="'.$value.'" '.$params.' '.$ck_str.' />';

            return $field;

    } // end form_ck()

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag input de tip radio.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $value Valoarea atributului value.
     * 
     * @param string $elementData Valoarea atributului value din tagul input de tip radio care este selectat.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_radio($name, $value, $elementData = '', $params = '')
    {

            $field = '<input type="radio" id="'.$value.'" name="'.$name.'" value="'.$value.'" '.$params;

            if ($elementData == $value) $field .= ' checked = "checked"';

            $field .= ' />';

            return $field;

    } // end form_radio()


    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag select cu tagurile oprion pe care le contine.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $type Tipul selectului.
     * 
     * @param array $initData Este un array pe baza caruia vor fi construite 
     *                          tagurile option din cadrul selectului, exemplu:
     *                          $initData = array(
     *                                  'en' => 'English',
     *                                  'ro' => 'Romana',
     *                                  'de' => 'Deutsch'),
     *                          cheile sale vor deveni valorile atributelor value din tagurile option, 
     *                          iar valorile acestui array vor deveni continutul tagurilor option.
     * 
     * @param array $elementData Un array ce contine valorile atributelor value din tagurile option care sunt selectate.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_select($name, $type = 'single', $initData = '', $elementData = '', $params = '')
    {
            if (!is_array($initData)) return '';

            // adaugam tagul select cu atributele sale
            $field = '<select size="3" name="'.$name.'[]"';

            // daca tipul este multiple aduagam atributul corespunzator
            if ($type == 'multiple') $field .= ' multiple = "multiple" '; 

            // adaugam lista de parametri
            $field .= $params.'>';	

            // adaugam tagurile option
            foreach ($initData as $k => $v)
            {

                    $field .= '<option value="'.$k.'"';

                    if (is_array($elementData) && in_array($k, $elementData)) $field .= ' selected="selected"';

                    $field .= '>'.$v.'</option>';
            } // end foreach

            $field .= '</select>';

            return $field;

    } /// form_select()

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza campuri de tip select, checkbox sau radio.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param bool $multiple Tipul selectiei, daca putem selecta mai multe opiuni. 
     *                      Implicit este false.
     * 
     * @param bool $expanded Modul de afisare (checkbox si radio sunt expanded, selectul nu este expandat.
     *                      Implicit este false.
     * 
     * @param array $initData Este un array pe baza caruia vor fi construite campurile acestui choice.
     *                          De exemplu daca avem select($expanded=false):
     *                          $initData = array(
     *                                  'en' => 'English',
     *                                  'ro' => 'Romana',
     *                                  'de' => 'Deutsch'),
     *                          cheile sale vor deveni valorile atributelor value din tagurile option, 
     *                          iar valorile acestui array vor deveni continutul tagurilor option.
     * 
     * @param string/array $elementData Un array sau string ce contine valorile/valoarea atributelor value care sunt selectate.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html corespunzator.
     * 
     */
    function form_choice($name, $multiple = false, $expanded = false, Array $initData = [], $elementData = null, $params = '')
    {

        if (false === $expanded){ // => avem un select

            // adaugam tagul select cu atributele sale
            $field = '<select';   

            // daca tipul este multiple aduagam atributul corespunzator
            if (true === $multiple) {
                $field .= ' multiple size=6';
                $name .= '[]';
            }    

            $field .= ' name="'.$name.'"';

            // adaugam lista de parametri
            if ($params) {
                $field .= ' '.$params.'>';	
            } else {
                 $field .= '>';
            }

            // adaugam tagurile option
            if (!$elementData){
                $field .= '<option disabled selected value> -- select an option -- </option>';
            } else {
                $field .= '<option disabled value> -- select an option -- </option>';
            }


            // adaugam tagurile option
            foreach ($initData as $k => $v)
            {

                    $field .= '<option value="'.$k.'"';

                    if ((is_array($elementData) && in_array($k, $elementData)) || (is_string($elementData) && ($k == $elementData))) {
                        $field .= ' selected';
                    } 

                    $field .= '>'.ucfirst($v).'</option>';
            } // end foreach

            $field .= '</select>';

            return $field;        

        }

        if (true === $expanded){ // => putem avea un radio sau un checkbox   
            if (true === $multiple){ // => checkbox
                $type = 'checkbox';
                $name .= '[]';
            } else { // => radio
                $type = 'radio';
            }

            // adaugam tagurile input
            $return = '<p>';
            foreach ($initData as $k => $v)
            {
                $return .= '<span>';
                $return .= $this->addLabel(ucfirst($v), $k);           

                $return .= '<input type="'.$type.'" id="'.$k.'" name="'.$name.'" value="'.$k.'"';

                if ($params) $return .= " $params";

                if ((is_array($elementData) && in_array($k, $elementData)) || (is_string($elementData) && ($k == $elementData)) ) $return .= ' checked';

                $return .=' />';
                $return .= '</span> ';

            } // end foreach        
            $return .= '</p>';
            return $return;  

        }


    } /// form_choice()

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag textarea.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $elementData Continutul tagului..
     * 
     * @param string $params Alte atribute care au sens pentru acet tag, 
     *                       de exemplu $params = 'style="color:red"' adauga un stil inline tagului.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_textarea($name, $elementData = '', $params = '')
    {
            $field = '<textarea name="'.$name.'" id="'.$name.'"';
            if ($params){
                $field .= " $params>";
            } else {
                $field .= '>';
            }
            $field .= $elementData;
            $field .= '</textarea>';


            return $field;
    }


    /*
     - o functie ce adauga un tag input de tip submit

     - $name = valoarea atributului name, valoare ce va deveni cheie in $_POST sau $_GET

     - $value = valoarea atributului value

     - $type = tipul butonului, implicit este submit

     - $params = alte atribute care au sens pentru acet tag

    */

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag input de tip submit.
     * 
     * @param string $name Valoarea atributului name, 
     *                     valoare ce va deveni cheie in $_POST sau $_GET 
     *                     de asemenea mai poate si folosit si ca valoare a atributului id.
     * 
     * @param string $value Valoarea atributului value.
     * 
     * @param string $type Tipul submitului.
     * 
     * @param string $params Alte atribute care au sens pentru acet tag.
     * 
     * @return string Codul html pentru acest tag.
     * 
     */
    function form_button($name, $value, $type="submit", $params = '')
    {
            $field = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$params.' />';
            return $field;
    }
    

}
