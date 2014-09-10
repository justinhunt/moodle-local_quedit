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
 * Controller for various actions of the block.
 *
 * This page display the community course search form.
 * It also handles adding a course to the community block.
 * It also handles downloading a course template.
 *
 * @package    block_community
 * @author     Jerome Mouneyrac <jerome@mouneyrac.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 */

require('../../config.php');
require_once($CFG->dirroot . '/blocks/quedit/locallib.php');
require_once($CFG->dirroot . '/blocks/quedit/forms.php');

require_login();
$courseid = required_param('courseid', PARAM_INT); //if no courseid is given
$action = required_param('action', PARAM_TEXT); //the user action to take
$groupid =  optional_param('groupid',0, PARAM_INT); //the id of the group
$queditid =  optional_param('queditid',0, PARAM_INT); //the id of the group

$parentcourse = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

$context = context_course::instance($courseid);
$PAGE->set_course($parentcourse);
$PAGE->set_url('/blocks/quedit/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('course');
$PAGE->set_title(get_string('listview', 'local_quedit'));
$PAGE->navbar->add(get_string('listview', 'local_quedit'));

$bmh = new local_quedit_manager($courseid);

// OUTPUT
echo $OUTPUT->header();
$message=false;

//only admins and editing teachers should get here really
if(!has_capability('block/quedit:managefamilies', $context) ){
	echo $OUTPUT->heading(get_string('inadequatepermissions', 'local_quedit'), 3, 'main');
	echo $OUTPUT->footer();
	return;
 }


//don't do anything without a groupid
if($groupid == 0){
	$action='group';
}else{		
	$groupname = groups_get_group_name($groupid);
	if(!$groupname){
		$message = get_string('invalidgroupid','local_quedit');
		$action='group';
	}
}


switch($action){
	
	case 'add':
		echo $OUTPUT->heading(get_string('addqueditheading', 'local_quedit',$groupname), 3, 'main');
		$addform = new local_quedit_add_form(null,array('groupid'=>$groupid));
		$addform->display();
		echo $OUTPUT->footer();
		return;
	

	
	case 'edit':
		echo $OUTPUT->heading(get_string('editqueditheading', 'local_quedit',$groupname), 3, 'main');
		$editform = new local_quedit_edit_form(null,array('groupid'=>$groupid));

		if($queditid > 0){
			$bmh = new local_quedit_manager();
			$hdata = $bmh->local_quedit_get_quedit($queditid);
			$hdata->queditid=$queditid;
			$editform->set_data($hdata);
			$editform->display();
		}else{
			echo get_string('invalidqueditid', 'local_quedit');
		}
		
		
		echo $OUTPUT->footer();
		return;
		

	
	case 'delete':
		echo $OUTPUT->heading(get_string('deletequeditheading', 'local_quedit',$groupname), 3, 'main');
		$deleteform = new local_quedit_delete_form(null,array('groupid'=>$groupid));
		
		if($queditid > 0){
			$bmh = new local_quedit_manager();
			$hdata = $bmh->local_quedit_get_quedit($queditid);
			$hdata->queditid=$queditid;		
			
			$modinfo = get_fast_modinfo($parentcourse);
			$cm = $modinfo->get_cm($hdata->cmid);
			$hdata->activityname =$cm->name;
			
			$hdata->startdate = userdate($hdata->startdate,'%d %B %Y');
			
			$deleteform->set_data($hdata);
			$deleteform->display();
		}else{
			echo get_string('invalidqueditid', 'local_quedit');
		}

		echo $OUTPUT->footer();
		return;
		
	case 'group':
		//might have been possible to use moodle groups dropdown
		//http://docs.moodle.org/dev/Groups_API see groups_print_activity_menu
	
		//if we have a status message, display it.
		if($message){
			echo $OUTPUT->heading($message,5,'main');
		}
		echo $OUTPUT->heading(get_string('selectgroup', 'local_quedit'), 3, 'main');
		$gdata = new stdClass();
		$gdata->courseid=$courseid;
		$gdata->groupid=$groupid;
		$groupform = new local_quedit_group_form(null,array('courseid'=>$courseid));
		$groupform->set_data($gdata);
		$groupform->display();
		echo $OUTPUT->footer();
		return;

	
	case 'doadd':
		//get add form
		$add_form = new local_quedit_add_form();
		//print_r($add_form);
		$data = $add_form->get_data();
		$ret = $bmh->local_quedit_add_quedit($data->groupid,$data->courseid,$data->cmid,$data->startdate);
		if($ret){
			$message = get_string('addedsuccessfully','local_quedit');
		}else{
			$message = get_string('failedtoadd','local_quedit');
		}
		break;
		
	case 'doedit':
		//get add form
		$edit_form = new local_quedit_edit_form();
		//print_r($add_form);
		$data = $edit_form->get_data();
		$ret = $bmh->local_quedit_edit_quedit($data->queditid, $data->groupid,$data->courseid,$data->cmid,$data->startdate);
		if($ret){
			$message = get_string('updatedsuccessfully','local_quedit');
		}else{
			$message = get_string('failedtoupdate','local_quedit');
		}
		break;
		
	case 'dodelete':
		//To do. here collect the data from the form and update in the db using. maybe
		//get add form
		$delete_form = new local_quedit_delete_form();
		$data = $delete_form->get_data();
		$ret = $bmh->local_quedit_delete_quedit($data->queditid);
		if($ret){
			$message = get_string('deletedsuccessfully','local_quedit');
		}else{
			$message = get_string('failedtodelete','local_quedit');
		}
		break;
		
	case 'dogroup':
		//To do. here collect the data from the form and update in the db using. maybe
		//get add form
		$group_form = new local_quedit_group_form();
		$data = $group_form->get_data();
		$groupid = $data->groupid;
		$message = get_string('groupupdated','local_quedit');

		break;
	
	case 'list':
	default:

}

	//if we have a status message, display it.
	if($message){
		echo $OUTPUT->heading($message,5,'main');
	}

	echo $OUTPUT->heading(get_string('queditlist', 'local_quedit', $groupname), 3, 'main');
	
	//group form
	//echo $OUTPUT->heading(get_string('selectgroup', 'local_quedit'), 3, 'main');
	$gdata = new stdClass();
	$gdata->courseid=$courseid;
	$gdata->groupid=$groupid;
	$groupform = new local_quedit_group_form();
	$groupform->set_data($gdata);
	$groupform->display();

	
	//list of quedits for current group
	$queditdata=$bmh->local_quedit_get_quedits($groupid,$courseid);
	if($queditdata){
		echo show_quedit_list($queditdata,$courseid,$groupid);
	}else{
		echo $OUTPUT->heading( get_string('noquedits','local_quedit',$groupname),4,'main');
	}
	echo show_buttons($groupid, $groupname);
	echo $OUTPUT->footer();
		

/**
 * Return the add list buttons at bottom of table (ugly
 * @param integer $groupid
 * @param integer $groupname
 * @return string html of buttons
 */
function show_buttons($groupid,$groupname){
	global $COURSE;
	
			$addurl = new moodle_url('/blocks/quedit/view.php', array('courseid'=>$COURSE->id,'action'=>'add','groupid'=>$groupid));
			echo '<br />' . html_writer::link($addurl,  get_string('addquedit','local_quedit',$groupname) );
			$listurl = new moodle_url('/blocks/quedit/view.php', array('courseid'=>$COURSE->id,'action'=>'list','groupid'=>$groupid));
			echo '<br />' . html_writer::link($listurl,  get_string('listquedits','local_quedit',$groupname) );

}

/**
 * Return the html table of quedits for a group  / course
 * @param array quedit objects
 * @param integer $courseid
 * @param integer $groupid
 * @return string html of table
 */
function show_quedit_list($queditdatas,$courseid,$groupid){

	global $COURSE;
	
	$table = new html_table();
	$table->id = 'local_quedit_panel';
	$table->head = array(
		get_string('startdate', 'local_quedit'),
		get_string('activitytitle', 'local_quedit'),
		get_string('actions', 'local_quedit')
	);
	$table->headspan = array(1,1,2);
	$table->colclasses = array(
		'startdate', 'activitytitle', 'edit','delete'
	);
	
	$modinfo = get_fast_modinfo($COURSE);

	//sort by start date
    core_collator::asort_objects_by_property($queditdatas,'startdate',core_collator::SORT_NUMERIC);

	//loop through the homoworks and add to table
	foreach ($queditdatas as $hwork) {
		$row = new html_table_row();
		
		
		$startdatecell = new html_table_cell(userdate($hwork->startdate,'%d %B %Y'));
		
		$cm = $modinfo->get_cm($hwork->cmid);
		$displayname=$cm->name;
		$activityname  = html_writer::tag('div', $displayname, array('class' => 'displayname'));
		$activitycell  = new html_table_cell($activityname);
		
		$actionurl = '/blocks/quedit/view.php';
		$editurl = new moodle_url($actionurl, array('queditid'=>$hwork->id,'action'=>'edit','courseid'=>$courseid,'groupid'=>$groupid));
		$editlink = html_writer::link($editurl, get_string('editqueditlink', 'local_quedit'));
		$editcell = new html_table_cell($editlink);
		
		$deleteurl = new moodle_url($actionurl, array('queditid'=>$hwork->id,'action'=>'delete','courseid'=>$courseid,'groupid'=>$groupid));
		$deletelink = html_writer::link($deleteurl, get_string('deletequeditlink', 'local_quedit'));
		$deletecell = new html_table_cell($deletelink);

		$row->cells = array(
			$startdatecell, $activitycell, $editcell, $deletecell
		);
		$table->data[] = $row;
	}

    return html_writer::table($table);

}