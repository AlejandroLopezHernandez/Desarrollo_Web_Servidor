<?php
class AnalizadorDiscurso{
    private $palabrasVacias = ["la", "el", "los", "las", "un", "una", "unos", "unas", "que", "de", "en", "y",
     "a", "es", "por", "con", "se", "como","no", "lo", "su", "al", "le",".",",",":",";","`","´","^"];
     private $texto;
    public function __construct(){
        $this->texto = '';
    }
    public function agregar_discurso($texto){
        this->texto=$texto;
    }
   
   
    
}
?>