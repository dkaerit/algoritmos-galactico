<?php

require_once('AlgoritmoGalactico.php');
require_once('MultiplicacionFourier.php');
require_once('MultiplicacionStrassen.php');
require_once('CanalComunicacionShannon.php');

// Función principal
function main() {
    // Menú de opciones
    $opciones = [
        1 => [
            'nombre' => 'Multiplicación de enteros (T. Fourier)',
            'clase' => 'MultiplicacionFourier',
        ],
        2 => [
            'nombre' => 'Multiplicación de matrices (Alg. Strassen)',
            'clase' => 'MultiplicacionStrassen',
        ],
        3 => [
            'nombre' => 'Canal de comunicación (Claude Shannon)',
            'clase' => 'CanalComunicacionShannon',
        ],
    ];

    echo "Seleccione un algoritmo galáctico:\n";
    foreach ($opciones as $opcion => $data) {
        echo "$opcion. " . $data['nombre'] . "\n";
    }

    // Obtener la opción del usuario
    $opcion = readline("Ingrese el número de opción: ");

    // Validar la opción ingresada
    if (!isset($opciones[$opcion])) {
        echo "Opción inválida. Saliendo...\n";
        return;
    }

    // Obtener el nombre de la clase del algoritmo seleccionado
    $nombreClase = $opciones[$opcion]['clase'];

    // Crear una instancia del algoritmo seleccionado
    $algoritmo = new $nombreClase();

    // Ejecutar el algoritmo seleccionado
    $algoritmo->ejecutar();
}

// Llamar a la función principal
main();

?>
