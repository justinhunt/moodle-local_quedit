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
 * Controller for various actions of the mod.
 *
 * This page handles the display of the local mod quedit
 * 
 *
 * @package    local_quedit
 * @author     Justin Hunt <poodllsupport@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2014 onwards Justin Hunt  http://poodll.com
 */

require('../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/local/quedit/locallib.php');
require_once($CFG->dirroot . '/local/quedit/forms.php');

//this would restrict the page to only admins
//admin_externalpage_setup('managequestions');

require_login();

//only managers and editing teachers should get here really
$context = context_system::instance();
require_capability('local/quedit:managequestions', $context);


$action = optional_param('action','getcategory' ,PARAM_TEXT); //the user action to take
$catid =  optional_param('catid',0, PARAM_INT); //the id of the group
$includechildren =  optional_param('includechildren',0, PARAM_INT); //the id of the group

$PAGE->set_url('/local/quedit/view.php');
$PAGE->set_context($context);
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('listview', 'local_quedit'));
$PAGE->navbar->add(get_string('listview', 'local_quedit'));
$renderer = $PAGE->get_renderer('local_quedit');

$bfm = new local_quedit_manager($catid);

// OUTPUT
echo $renderer->header();
$message=false;

if(false){
	echo $renderer->heading(get_string('inadequatepermissions', 'local_quedit'), 3, 'main');
	echo $renderer->footer();
	return;
 }

switch($action){
	
	case 'dogetcategory':
		//To do. here collect the data from the form and update in the db using. maybe
		//get add form
		
		$cat_form = new local_quedit_category_form(null, array());
		$data = $cat_form->get_data();
		$catid = $data->catid;
		$includechildren = $data->includechildren;
		$message = get_string('category_updated','local_quedit');
		break;


	case 'domany':	
		$manyform = new local_quedit_many_form();
		$manydata = $manyform->get_data();
		if(!$manydata){
			$message = get_string('wedontaddfields', 'local_quedit');
			break;
		}
		
		$catid = $manydata->catid;
		$bfm = new local_quedit_manager($catid);
		$result = $bfm->update_many($manydata);
		if($result){
			$message = get_string('updatedsuccessfully', 'local_quedit',$result);
		}else{
			$message=  get_string('failedtoupdate', 'local_quedit');
			local_quedit_show_error($renderer,$message);
			return;	
		}
	
	
	case 'getcategory':
	default:
		//if we have a status message, display it.
		if($message){
			echo $renderer->heading($message,5,'main');
		}
		echo $renderer->heading(get_string('select_category', 'local_quedit'), 3, 'main');
		$gdata = new stdClass();
		if($catid){$gdata->catid=$catid;}
		if($includechildren){$gdata->includechildren=$includechildren;}
		//$contexts = x;null, array('contexts'=>$contexts)
		$catform = new local_quedit_category_form();
		$catform->set_data($gdata);
		$catform->display();
		echo $renderer->footer();
		return;
}

local_quedit_show_all_questions($catid, $includechildren, $renderer, $message);

	/**
	 * Show *all* families
	 * @param string $message any status messages can be displayed
	 */
	function local_quedit_show_all_questions($catid,$includechildren, $renderer, $message=false){
		if($message){
			echo $renderer->heading($message,5,'main');
		}
		$gdata = new stdClass();
		$catform = new local_quedit_category_form();
		$gdata->catid = $catid;
		$gdata->includechildren = $includechildren;
		$catform->set_data($gdata);
		$catform->display();
		
		
		$bfm = new local_quedit_manager($catid);
		$queditdata =  $bfm->get_qanda2($catid, $includechildren, 'multichoice');
		//print_r($queditdata);
		$fieldcount = count($queditdata['qid']);
		if($fieldcount>0){
		$manyform = new local_quedit_many_form(null,array('fieldcount'=>$fieldcount));
		$manyform->set_data($queditdata);
		$manyform->display();
		}else{
			echo $renderer->heading(get_string('noquestions', 'local_quedit'),5,'main');
		}
		//print_r($queditdata);
		//$renderer->show_families_list($queditdata, $message);
	}