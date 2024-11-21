<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Cálculo del Factor de Relevancia</title> 
</head> 
<body> 
    <h2>Calculadora del Factor de Relevancia</h2> 
    <form method="post"> 
    <!--Este formulario tiene dos inputs, uno de un formulario de entrada
    y otro para validar datos -->    
        Número de enlaces en la página: <input type="text" 
name="enlacesPagina" required><br><br> 
        Número total de enlaces en el sitio: <input type="text" 
name="totalEnlaces" required><br><br> 
        <input type="submit" value="Calcular Relevancia"> 
    </form> 
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        //Ojo, lo selecciona por nombre y no por ID
        $enlacesPagina = $_POST["enlacesPagina"]; 
        $totalEnlaces = $_POST["totalEnlaces"]; 
         
        if (is_numeric($enlacesPagina) && 
is_numeric($totalEnlaces) && $totalEnlaces > 0) { 
            $relevancia = ($enlacesPagina / $totalEnlaces) * 100; 
            echo "<p>El factor de relevancia es: " . 
number_format($relevancia, 2) . "%</p>"; 
        } else { 
            echo "<p>Por favor, introduce valores válidos y 
asegúrate de que el número total de enlaces sea mayor que 
cero.</p>"; 
        } 
    } 
    ?> 
</body> 
</html> 