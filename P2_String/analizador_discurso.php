<?php
class AnalizadorDiscurso{
    private $palabrasVacias = ["la", "el", "los", "las", "un", "una", "unos", "unas", "que", "de", "en", "y",
     "a", "es", "por", "con", "se", "como","no", "lo", "su", "al", "le",".",",",":",";","`","´","^"];

     private $texto;
    public function __construct(){
        $this->texto = '';
    }
    public function agregar_discurso($texto){
        $this->texto=$texto;
    }
    public function analizar(){
        $texto_limpio = str_replace($this->palabrasVacias,'',$this->texto);
        print_r("El texto sin signos de puntuación y palabras vacías es: ".$texto_limpio);

        $texto_minusculas = strtolower($this->texto);
        $array_palabras = explode(" ",$texto_minusculas);
        print_r("Palabras separadas: ".print_r($array_palabras,true));

        $palabras = str_word_count($this->texto,1);
        $frecuencia = array_count_values($palabras);
        print_r("La frecuencia de cada palabras es: ".print_r($frecuencia,true));

        arsort($frecuencia);
        $tres_palabras = array_slice($frecuencia,0,3);

        print_r("Las tres palabras más usadas son: ".print_r($tres_palabras,true));
    }
}
?>