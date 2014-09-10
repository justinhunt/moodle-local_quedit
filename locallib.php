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
 * Community library
 *
 * @package    local_quedit
 * @author     Justin Hunt <poodllsupport@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2014 onwards Justin Hunt
 *
 *
 */
 
require_once($CFG->dirroot . '/local/quedit/lib.php');

class local_quedit_manager {

	private $catid=0;
	
	/**
     * constructor. make sure we have the right course
     * @param integer courseid id
	*/
	function local_quedit_manager($catid=0) {
			$this->catid=$catid;
    }


  /**
     * Add a quedit role
     * @param integer group id
     * @param integer course module id
     * @return id of quedit or false if already added
     */
    public function get_question_categories() {
        global $DB;
		//$ret = $DB->get_records('question_categories',array('parent'=>0));
		$ret = $DB->get_records('question_categories');
       return $ret;
    }
	
	public function get_qanda($catid){
		$qandas = array();
		$questions = $this->get_questions($catid);
		foreach ($questions as $question){
			$aqanda = new stdClass();
			$aqanda->qid = $question->id;
			$aqanda->questiontext = $question->questiontext;
			$answers = $this->get_answers($question->id);
			$count = 1;
			foreach ($answers as $answer){
				switch($count){
					case 1: $aqanda->aid_1 = $answer->id; $aqanda->atext_1 = $answer->answer;break;
					case 2: $aqanda->aid_2 = $answer->id; $aqanda->atext_2 = $answer->answer;break;
					case 3: $aqanda->aid_3 = $answer->id; $aqanda->atext_3 = $answer->answer;break;
					case 4: $aqanda->aid_4 = $answer->id; $aqanda->atext_4 = $answer->answer;break;
					default: break;
				}
				$count++;
			}
			$qandas[]=$aqanda;
		}
		return $qandas;
	}

	public function get_qanda2($catid){
		$questions = $this->get_questions($catid);
		$qid=array();
		$questiontext=array();
		$aid_1=array();
		$atext_1=array();
		$aid_2=array();
		$atext_2=array();
		$aid_3=array();
		$atext_3=array();
		$aid_4=array();
		$atext_4=array();
		
		foreach ($questions as $question){

			$qid[] = $question->id;
			$questiontext[] = $question->questiontext;
			$answers = $this->get_answers($question->id);
			$count = 1;
			foreach ($answers as $answer){
				switch($count){
					case 1: $aid_1[] = $answer->id; $atext_1[] = $answer->answer;break;
					case 2: $aid_2[] = $answer->id; $atext_2[] = $answer->answer;break;
					case 3: $aid_3[] = $answer->id; $atext_3[] = $answer->answer;break;
					case 4: $aid_4[] = $answer->id; $atext_4[] = $answer->answer;break;
					default: break;
				}
				$count++;
			}
			//make sure we dont add strage data if there are only 2 or 3 options
			while($count<5){
					switch($count){
						case 1: $aid_1[] = 0; $atext_1[] = '';break;
						case 2: $aid_2[] = 0; $atext_2[] = '';break;
						case 3: $aid_3[] = 0; $atext_3[] = '';break;
						case 4: $aid_4[] = 0; $atext_4[] = '';break;
						default: break;
					}
					$count++;
			}
			
		}
		return array('catid'=>$catid,'qid'=>$qid,'questiontext'=>$questiontext,
			'aid_1'=>$aid_1,'atext_1'=>$atext_1,
			'aid_2'=>$aid_2,'atext_2'=>$atext_2,
			'aid_3'=>$aid_3,'atext_3'=>$atext_3,
			'aid_4'=>$aid_4,'atext_4'=>$atext_4,
			);
	}
	
	public function update_many($manydata){
		global $DB;
		$update=0;
		for($i=0;$i<count($manydata->qid);$i++){
				if(!empty( $manydata->questiontext[$i]) && $manydata->qid[$i]>0 ){
					$ret1 = $DB->set_field('question', 'questiontext', $manydata->questiontext[$i], array('id'=>$manydata->qid[$i]));
				}
				
				if(!empty( $manydata->atext_1[$i]) && $manydata->aid_1[$i]>0 ){
					$ret2 = $DB->set_field('question_answers', 'answer', $manydata->atext_1[$i], array('id'=>$manydata->aid_1[$i]));
				}
				
				if(!empty( $manydata->atext_2[$i]) && $manydata->aid_2[$i]>0 ){
					$ret3 = $DB->set_field('question_answers', 'answer', $manydata->atext_2[$i], array('id'=>$manydata->aid_2[$i]));
				}
				
				if(!empty( $manydata->atext_3[$i]) && $manydata->aid_3[$i]>0 ){
					$ret4 = $DB->set_field('question_answers', 'answer', $manydata->atext_3[$i], array('id'=>$manydata->aid_3[$i]));
				}
				
				if(!empty( $manydata->atext_4[$i]) && $manydata->aid_4[$i]>0 ){
					$ret5 = $DB->set_field('question_answers', 'answer', $manydata->atext_4[$i], array('id'=>$manydata->aid_4[$i]));
				}
				
				//if($ret1 && $ret2 && $ret3 && $ret4 && $ret5){
					$update++;
			//	}
		}
		return $update;
	}


	
 /**
     * Add a quedit role
     * @param integer group id
     * @param integer course module id
     * @return id of quedit or false if already added
     */
    public function get_questions($catid) {
        global $DB;
		//$result = $DB->get_records_sql('SELECT * FROM {question} qt INNER JOIN {question_answers} qta ON qta.question= qt.id WHERE qt.category = ?', array( $catid));
		$result = $DB->get_records('question', array('category' => $catid,'qtype'=>'videoproctormc'));
		//$result = $DB->get_records('question', array('category' => $catid,'qtype'=>'multichoice'));
		return $result;
    }
/**
     * Add a quedit role
     * @param integer group id
     * @param integer course module id
     * @return id of quedit or false if already added
     */
    public function get_answers($questionid) {
        global $DB;
		$result = $DB->get_records('question_answers',array('question'=>$questionid));
       return $result;
    }
 
   
}

    
/**
 * An exception for reporting errors when processing local_quedit files
 *
 * Extends the moodle_exception with an http property, to store an HTTP error
 * code for responding to AJAX requests.
 */
class local_quedit_exception extends moodle_exception {

    /**
     * Stores an HTTP error code
     *
     * @var int
     */
    public $http;

    /**
     * Constructor, creates the exeption from a string identifier, string
     * parameter and HTTP error code.
     *
     * @param string $errorcode
     * @param string $a
     * @param int $http
     */
    public function __construct($errorcode, $a, $http) {
        parent::__construct($errorcode, 'local_quedit', '', $a);
        $this->http = $http;
    }
}
