<?php
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
 * quedit 
 *
 * @package    local_quedit
 * @copyright  Justin Hunt <poodllsupport@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$ADMIN->add('root', new admin_category('local_quedit', get_string('quedit', 'local_quedit')));

$ADMIN->add('local_quedit', new admin_externalpage('managequestions', get_string('manage_questions', 'local_quedit'),
        $CFG->wwwroot."/local/quedit/view.php?action=getcategory",
        'moodle/site:config'));

/*		
$ADMIN->add('local_quedit', new admin_externalpage('uploadquestions', get_string('uploadquestions', 'local_quedit'),
        $CFG->wwwroot."/local/quedit/view.php?action=uploadfile",
        'moodle/site:config'));
*/
/*		
$ADMIN->add('local_quedit', new admin_externalpage('exportquestions', get_string('exportquestions', 'local_quedit'),
        $CFG->wwwroot."/local/quedit/exportquestions.php",
        'moodle/site:config'));
		*/