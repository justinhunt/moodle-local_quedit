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
 * Forms for quedit Block
 *
 * @package    local_quedit
 * @author     Justin Hunt <poodllsupport@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Justin Hunt  http://poodll.com
 */

require_once($CFG->libdir . '/formslib.php');


class local_quedit_category_form extends moodleform {

    public function definition() {
        global $CFG, $USER, $OUTPUT, $COURSE;
        $strrequired = get_string('required');
        $mform = & $this->_form;
		$bmh = new local_quedit_manager();

		
		$cats = $bmh->get_question_categories();
		$options =array();
		foreach($cats as $cat){
			$options[$cat->id] = $cat->name;
		}

		$mform->addElement('select', 'catid', get_string('select_category','local_quedit'),$options);
        $mform->setType('catid', PARAM_INT);
	
		$mform->addElement('advcheckbox', 'includechildren', get_string('includechildren', 'local_quedit'),'',null, array(0, 1));
		$mform->setType('includechildren', PARAM_INT);
		
		$mform->addElement('hidden', 'action', 'dogetcategory');
        $mform->setType('action', PARAM_TEXT);

		
		$mform->addElement('submit', 'submitbutton', get_string('docat_label', 'local_quedit'));

	}

}

class local_quedit_category_form_new extends moodleform {

    public function definition() {
        global $CFG, $USER, $OUTPUT, $COURSE;
        $strrequired = get_string('required');
        $contexts   = $this->_customdata['contexts'];
        $mform = & $this->_form;
		
		$mform->addElement('questioncategory', 'catid', get_string('category', 'question'),
    		array('contexts'=>$contexts, 'top'=>true));
		/*
		$mform->addElement('questioncategory', 'category', get_string('category', 'question'),
    array('contexts'=>$contexts, 'top'=>true, 'currentcat'=>$currentcat, 'nochildrenof'=>$currentcat));
    */



		
		$mform->addElement('hidden', 'action', 'dogetcategory');
        $mform->setType('action', PARAM_TEXT);

		
		$mform->addElement('submit', 'submitbutton', get_string('docat_label', 'local_quedit'));

	}

}


class local_quedit_many_form extends moodleform {

    public function definition() {
        global $CFG, $USER, $OUTPUT, $COURSE;
        $strrequired = get_string('required');
        $mform = & $this->_form;
		
		$fieldcount = $this->_customdata['fieldcount'];
		
		
		$repeatel = array();
		$repeatel[] = $mform->createElement('hidden', 'qid');
		$repeatel[] = $mform->createElement('textarea', 'questiontext',get_string('question_label','local_quedit'),array('wrap'=>"virtual", 'rows'=>2, 'class'=>'local_quedit_qtextarea', 'cols'=>50));
		
		
		$repeatgroup=array();
        $repeatgroup[] = $mform->createElement('hidden', 'aid_1');
		$repeatgroup[] = $mform->createElement('textarea', 'atext_1','','wrap="virtual" class="local_quedit_atextarea" rows="3" cols="9"');
        $repeatgroup[] = $mform->createElement('hidden', 'aid_2');
		$repeatgroup[] = $mform->createElement('textarea', 'atext_2','','wrap="virtual" class="local_quedit_atextarea" rows="3" cols="9"');
        $repeatgroup[] = $mform->createElement('hidden', 'aid_3');
		$repeatgroup[] = $mform->createElement('textarea', 'atext_3','','wrap="virtual" class="local_quedit_atextarea" rows="3" cols="9"');
       $repeatgroup[] = $mform->createElement('hidden', 'aid_4');
		$repeatgroup[] = $mform->createElement('textarea', 'atext_4','','wrap="virtual" class="local_quedit_atextarea" rows="3" cols="9"');
		
		$repeatel[] =	 $mform->createElement('group', 'answers', get_string('answers_label','local_quedit'), $repeatgroup, null,false);
		$repeatel[] = $mform->createElement('static', 'hrule','<hr/>'); 
		
		$repeateloptions = array();
		$repeateloptions['qid']['type'] = PARAM_INT;
		$repeateloptions['questiontext']['type'] = PARAM_TEXT;
		$repeateloptions['aid_1']['type'] = PARAM_INT;
		$repeateloptions['atext_1']['type'] = PARAM_TEXT;
		$repeateloptions['aid_2']['type'] = PARAM_INT;
		$repeateloptions['atext_2']['type'] = PARAM_TEXT;
		$repeateloptions['aid_3']['type'] = PARAM_INT;
		$repeateloptions['atext_3']['type'] = PARAM_TEXT;
		$repeateloptions['aid_4']['type'] = PARAM_INT;
		$repeateloptions['atext_4']['type'] = PARAM_TEXT;
		
		$this->repeat_elements($repeatel, $fieldcount,
                    $repeateloptions, 'repeats', 'add_fields', 0, null, true);
		
		$mform->addElement('hidden', 'catid');
		$mform->addElement('hidden', 'action', 'domany');
        $mform->setType('catid', PARAM_INT);
		$mform->setType('action', PARAM_TEXT);		
	
		$this->add_action_buttons(true,get_string('domany_label', 'local_quedit'));
	
	}

}

