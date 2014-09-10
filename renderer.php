<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////


/**
 * Local quedit renderer.
 * @package   local_quedit
 * @copyright 2014 Justin Hunt (poodllsupport@gmail.com)
 * @author    Justin Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_quedit_renderer extends plugin_renderer_base {

	/**
	 * Show a form
	 * @param mform $showform the form to display
	 * @param string $heading the title of the form
	 * @param string $message any status messages from previous actions
	 */
	function show_form($showform,$heading, $message=''){
		global $OUTPUT;
	
		//if we have a status message, display it.
		if($message){
			echo $this->output->heading($message,5,'main');
		}
		echo $this->output->heading($heading, 3, 'main');
		$showform->display();
		echo $this->output->footer();
	}
	
}
