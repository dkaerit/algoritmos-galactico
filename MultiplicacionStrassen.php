<?php

// Clase derivada: Multiplicación de matrices con el algoritmo de Strassen
class MultiplicacionStrassen extends AlgoritmoGalactico {
    public function ejecutar() {
        // Lógica específica del algoritmo de multiplicación de matrices con Strassen
        echo "Ejecutando multiplicación de matrices con el algoritmo de Strassen...\n";

        // Obtener las dimensiones de las matrices
        $fila1 = intval(readline("Ingrese el número de filas de la primera matriz: "));
        $columna1 = intval(readline("Ingrese el número de columnas de la primera matriz: "));
        $fila2 = intval(readline("Ingrese el número de filas de la segunda matriz: "));
        $columna2 = intval(readline("Ingrese el número de columnas de la segunda matriz: "));

        // Verificar si las matrices son multiplicables
        if ($columna1 !== $fila2) {
            echo "Las matrices no son compatibles para la multiplicación.\n";
            return;
        }

        // Crear las matrices
        $matriz1 = $this->crearMatriz($fila1, $columna1);
        $matriz2 = $this->crearMatriz($fila2, $columna2);

        // Realizar la multiplicación de matrices utilizando el algoritmo de Strassen
        $resultado = $this->multiplicarStrassen($matriz1, $matriz2);

        // Mostrar el resultado
        echo "El resultado de la multiplicación es:\n";
        $this->mostrarMatriz($resultado);
    }

    private function crearMatriz($fila, $columna) {
        // Crear una matriz vacía
        $matriz = [];
        for ($i = 0; $i < $fila; $i++) {
            $matriz[$i] = [];
            for ($j = 0; $j < $columna; $j++) {
                $matriz[$i][$j] = intval(readline("Ingrese el valor de la posición ($i, $j): "));
            }
        }

        return $matriz;
    }

    private function multiplicarStrassen($matriz1, $matriz2) {
        // Obtener las dimensiones de las matrices
        $fila1 = count($matriz1);
        $columna1 = count($matriz1[0]);
        $fila2 = count($matriz2);
        $columna2 = count($matriz2[0]);

        // Verificar si las matrices son compatibles para la multiplicación
        if ($columna1 !== $fila2) {
            echo "Las matrices no son compatibles para la multiplicación.\n";
            return [];
        }

        // Verificar si las matrices son matrices de 1x1
        if ($fila1 === 1 && $columna1 === 1 && $fila2 === 1 && $columna2 === 1) {
            $resultado[0][0] = $matriz1[0][0] * $matriz2[0][0];
            return $resultado;
        }

        // Dividir las matrices en submatrices
        $matrizA = $this->dividirMatriz($matriz1);
        $matrizB = $this->dividirMatriz($matriz2);

        // Calcular las siete multiplicaciones de Strassen
        $m1 = $this->multiplicarStrassen($this->sumaMatrices($matrizA[0][0], $matrizA[1][1]), $this->sumaMatrices($matrizB[0][0], $matrizB[1][1]));
        $m2 = $this->multiplicarStrassen($this->sumaMatrices($matrizA[1][0], $matrizA[1][1]), $matrizB[0][0]);
        $m3 = $this->multiplicarStrassen($matrizA[0][0], $this->restarMatrices($matrizB[0][1], $matrizB[1][1]));
        $m4 = $this->multiplicarStrassen($matrizA[1][1], $this->restarMatrices($matrizB[1][0], $matrizB[0][0]));
        $m5 = $this->multiplicarStrassen($this->sumaMatrices($matrizA[0][0], $matrizA[0][1]), $matrizB[1][1]);
        $m6 = $this->multiplicarStrassen($this->restarMatrices($matrizA[1][0], $matrizA[0][0]), $this->sumaMatrices($matrizB[0][0], $matrizB[0][1]));
        $m7 = $this->multiplicarStrassen($this->restarMatrices($matrizA[0][1], $matrizA[1][1]), $this->sumaMatrices($matrizB[1][0], $matrizB[1][1]));

        // Calcular las submatrices resultantes
        $c11 = $this->restarMatrices($this->sumaMatrices($this->sumaMatrices($m1, $m4), $m7), $m5);
        $c12 = $this->sumaMatrices($m3, $m5);
        $c21 = $this->sumaMatrices($m2, $m4);
        $c22 = $this->restarMatrices($this->sumaMatrices($this->restarMatrices($m1, $m2), $m3), $m6);

        // Combinar las submatrices resultantes en la matriz final
        $resultado = $this->combinarMatriz($c11, $c12, $c21, $c22);

        return $resultado;
    }

    private function dividirMatriz($matriz) {
        $fila = count($matriz);
        $columna = count($matriz[0]);

        $mitad = intval($fila / 2);

        $submatriz[0][0] = array_slice($matriz, 0, $mitad);
        $submatriz[0][1] = array_slice($matriz, 0, $mitad);
        $submatriz[1][0] = array_slice($matriz, $mitad);
        $submatriz[1][1] = array_slice($matriz, $mitad);

        return $submatriz;
    }

    private function sumaMatrices($matriz1, $matriz2) {
        $fila = count($matriz1);
        $columna = count($matriz1[0]);

        $resultado = [];
        for ($i = 0; $i < $fila; $i++) {
            $resultado[$i] = [];
            for ($j = 0; $j < $columna; $j++) {
                $resultado[$i][$j] = $matriz1[$i][$j] + $matriz2[$i][$j];
            }
        }

        return $resultado;
    }

    private function restarMatrices($matriz1, $matriz2) {
        $fila = count($matriz1);
        $columna = count($matriz1[0]);

        $resultado = [];
        for ($i = 0; $i < $fila; $i++) {
            $resultado[$i] = [];
            for ($j = 0; $j < $columna; $j++) {
                $resultado[$i][$j] = $matriz1[$i][$j] - $matriz2[$i][$j];
            }
        }

        return $resultado;
    }

    private function combinarMatriz($c11, $c12, $c21, $c22) {
        $fila1 = count($c11);
        $columna1 = count($c11[0]);
        $fila2 = count($c21);
        $columna2 = count($c21[0]);

        $resultado = [];
        for ($i = 0; $i < $fila1 + $fila2; $i++) {
            $resultado[$i] = [];
            for ($j = 0; $j < $columna1 + $columna2; $j++) {
                if ($i < $fila1 && $j < $columna1) {
                    $resultado[$i][$j] = $c11[$i][$j];
                } elseif ($i < $fila1 && $j >= $columna1) {
                    $resultado[$i][$j] = $c12[$i][$j - $columna1];
                } elseif ($i >= $fila1 && $j < $columna1) {
                    $resultado[$i][$j] = $c21[$i - $fila1][$j];
                } else {
                    $resultado[$i][$j] = $c22[$i - $fila1][$j - $columna1];
                }
            }
        }

        return $resultado;
    }

    private function mostrarMatriz($matriz) {
        $fila = count($matriz);
        $columna = count($matriz[0]);

        for ($i = 0; $i < $fila; $i++) {
            for ($j = 0; $j < $columna; $j++) {
                echo $matriz[$i][$j] . "\t";
            }
            echo "\n";
        }
    }
}

?>
