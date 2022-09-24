<?php


/**
 * Prueba Unitaria 
 * @author Cristian Duvan Machado Mosquera <cristian.machado@correounivalle.edu.co>
 * @dec Comprobar que que el capabilities en el archetypes sole le de permisos a los editingteacher
*/

//definicion de la clase
class CapabilityTest extends advanced_testcase {


    /**
     * Comprueba si el usuario tiene permiso para 
     * Usar el plugin definido en el capability
    */
    public function testPermisos() {

        /**
         * Se necesita esta variable para poder usar el metodo
         * ya que de no usarla arroja un error por la bd
         * este error pasa por que se modifica la bd
         * y se vuelve a modificar en el mismo test sin
         * resetear el estado en la bd
         * mas informacion la documentacion de moodle
         * https://docs.moodle.org/dev/Writing_PHPUnit_tests
        */
        $this->resetAfterTest(true);

        //genera un usuario para el test 
        $user = $this->getDataGenerator()->create_user();

        //genera un curso para el test
        $course = $this->getDataGenerator()->create_course();

        //genera un rol editingteacher es el rol que tiene permiso para usar el plugin y es 3
        //diferente de 3 es que no tiene permiso
        $editingteacherroleid = 5;


        //asigna el rol al usuario
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $editingteacherroleid);

        //asignar el usuario al curso para el contexto
        $this->setUser($user);

        //saca el contexto del curso
        $context = context_course::instance($course->id);

        //retorna true si el usuario tiene el permiso para usar el plugin
        return $this->assertTrue(
            has_capability('local/customgrader:index', $context)
        );

    }

}



?>