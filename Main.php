<?php

// Función principal
function main() {
    // Menú de opciones
    echo "Seleccione un algoritmo galáctico:\n";
    echo "1. Multiplicación de enteros usando el teorema de Fourier\n";
    echo "2. Multiplicación de matrices con el algoritmo de Strassen\n";
    echo "3. Canal de comunicación de Claude Shannon\n";

    // Obtener la opción del usuario
    $opcion = readline("Ingrese el número de opción: ");

    // Incluir el archivo correspondiente al algoritmo seleccionado
    if ($opcion == 1) {
        require_once('MultiplicacionFourier.php');
        $algoritmo = new MultiplicacionFourier();
    } elseif ($opcion == 2) {
        require_once('MultiplicacionStrassen.php');
        $algoritmo = new MultiplicacionStrassen();
    } elseif ($opcion == 3) {
        require_once('CanalComunicacionShannon.php');
        $algoritmo = new CanalComunicacionShannon();
    } else {
        echo "Opción inválida. Saliendo...\n";
        return;
    }

    // Ejecutar el algoritmo seleccionado
    $algoritmo->ejecutar();
}

// Llamar a la función principal
main();

?>