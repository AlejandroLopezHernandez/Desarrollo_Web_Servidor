<?php
class AnalizadorDeDiscurso {
    // Palabras prohibidas 
    private $palabrasProhibidas = ['el', 'la', 'los', 'las', 'un', 'una', 'unos', 'unas', 'y', 'de', 'a', 'en', 'que', 'por', 'para', 'con', 'como', 'es', 'o', 'al', 'del'];
    private  $signosDePuntuacion = [".", ",", ";", ":", "?", "!", "(", ")", "[", "]", "{", "}", "-", "_", "\"", "'"];
    // Texto del discurso que será agregado
    private $texto;

    // Constructor vacío
    public function __construct() {
        $this->texto = '';
    }

    // Método para agregar un discurso
   
    public function agregarDiscurso($texto) {
        $this->texto = $texto;
    }

    // Método principal que analiza el texto y devuelve las tres palabras más importantes
    public function analizar() {
        // Convertir el texto a minúsculas
        $textoLimpio = strtolower($this->texto);

        

        // Eliminar los signos de puntuación utilizando str_replace
        $textoLimpio = str_replace($this->signosDePuntuacion, '', $textoLimpio);

        // Separar el texto en palabras
        $palabras = explode(' ', $textoLimpio);

      
    // Eliminar palabras prohibidas 
        $palabrasFiltradas = array_diff($palabras, $this->palabrasProhibidas);

        // Contar la frecuencia de cada palabra
        $frecuencia = array_count_values($palabrasFiltradas);

        // Ordenar las palabras por su frecuencia en orden descendente
        arsort($frecuencia);

        // Obtener las tres palabras más importantes (más frecuentes)
        $palabrasMasFrecuentes = array_slice($frecuencia, 0, 3, true);

        return $palabrasMasFrecuentes;
    }

    
}