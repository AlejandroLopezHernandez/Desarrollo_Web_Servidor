<?php
$horas = [6,5,5,6,1,7,5,1,2,3,5,3,5,5,7,6.5,5,3];
$notas = [6,8,6,5,8,7,5,7,6,6,7,6,9,7,6,5,6];

function calcular_media($horas){
    $n_estudiantes = count($horas);
    $suma_horas = array_sum($horas);
    $media = $suma_horas/$n_estudiantes;
    return $media;
}
echo "La media de horas que le dedica cada estudiante a la semana es de: ". calcular_media($horas);

function calcular_mediana($horas){
    sort($horas);
    $n_elementos = count($horas);
    if($n_elementos % 2 == 0){
        $mediana = ($horas[$n_elementos / 2 - 1] + $horas[$n_elementos/2]) / 2;
    } else {
        $mediana = $horas[floor($n_elementos/2)];
    }
    return $mediana;
}
echo "
";
echo "La mediana es: ".calcular_mediana($horas);
function calcular_rango($horas){
    $valor_max = max($horas);
    $valor_min = min($horas);
    return $valor_max - $valor_min;
}
echo "
";
echo "El rango de horas de estudio es de: ".calcular_rango($horas);
echo "prueba";

function desviacion_estandar($horas){
$n_elementos = count($horas);
$media = array_sum($horas)/$n_elementos;
$suma_diferencias_cuadrado = 0;
foreach ($horas as $hora){
    $suma_diferencias_cuadrado += pow($hora - $media,2);
}
$desviacion_estandar = sqrt($suma_diferencias_cuadrado/$n_elementos);
return $desviacion_estandar;
}
echo "
";
echo "La desviación estándar es de: ".desviacion_estandar($horas);
