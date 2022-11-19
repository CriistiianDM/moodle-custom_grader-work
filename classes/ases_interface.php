<?php
namespace local_customgrader;
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Custom grader report for ASES utitlities
 *
 * @author     Luis Gerardo Manrique Cardona
 * @package    block_ases
 * @copyright  2018 Luis Gerardo Manrique Cardona <luis.manrique@correounivalle.edu.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * 
 */

 /**
  * Contains all methods to comunicate with ASES plugin
  * @see {@link https://github.com/sistemasases/moduloases}
  */
class ases_interface
{
    const TRACKING_STATUS_ACTIVE = 1;

    /**
     * @param $mdl_id string|number related to mdl_user.id
     */
    static function is_ases_by_mdl_id($mdl_id)
    {
        //console.log en php

    global $DB;
    $sql_query_id_coherte_ases = "SELECT id  FROM mdl_cohort
                        WHERE idnumber = 'ases_activos'";
    
    $id_cohorte_ases = $DB->get_record_sql($sql_query_id_coherte_ases)->id;

    return $DB->record_exists(
        'cohort_members',
        array(
            'userid' => $mdl_id,
            'cohortid' => $id_cohorte_ases
        ));
    }
}