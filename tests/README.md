# PRUEBA UNITARIA
Para ejecutar la prueba unitaria, se debe tener instalado el phpUnit

## Objetivo
El objetivo de la prueba unitaria es verificar que las capasibilidad del plugin solo le aparezca a los usuarios que tienen dicha capacidad.

## Ejecución
Para ejecutar la prueba unitaria, se debe ejecutar el siguiente comando en la raíz del plugin:
```   
    1. php admin/tool/phpunit/cli/init.php 
    2. /moodle/: ./vendor/bin/phpunit  ./local/customgrader/tests/capability_test.php 
```
