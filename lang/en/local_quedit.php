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
 * Strings for component 'local_quedit', language 'en'
 *
 * @package   local_quedit
 * @copyright Daniel Neis <danielneis@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['quedit:managequestions'] = 'Manage Questions';
$string['managequestions'] = 'Manage Questions';
$string['manage_questions'] = 'Manage Questions';
$string['pluginname'] = 'quedit';
$string['quedit'] = 'quedit';
$string['docat_label'] = 'Select Category';
$string['select_category'] = 'Select Category';
$string['selectcategory'] = 'Select Category';
$string['category_updated'] = 'Category Updated';
$string['domany_label'] = 'Update All';
$string['question_label'] = 'Question';
$string['answers_label'] = 'Answers';
$string['updatedsuccessfully'] = '{$a} Questions Updatefully';
$string['failedtoupdate'] = 'Failed to update questions.';
$string['noquestions'] = 'Category contains no questions.';
$string['wedontaddfields'] = 'We do not add fields.';

$string['listview'] = 'quedit Assignments';
$string['queditlist'] = 'quedit: {$a}';
$string['listfamilies'] = 'List families';
$string['addquedit'] = 'Add a quedit';
$string['queditactivity'] = 'quedit Activity';
$string['addedsuccessfully'] = 'The quedit was added successfully';
$string['failedtoaddquedit'] = 'Failed to add quedit.';
$string['failedtoaddqueditmember'] = 'Failed to add quedit member. Possibly already a member of another quedit.';
$string['failedtogetmemberinfo'] = 'Failed to get quedit member information.';
$string['doaddquedit_label'] = 'Insert';
$string['doeditquedit_label'] = 'Update';
$string['dodeletequedit_label'] = 'Delete';
$string['doaddrole_label'] = 'Insert';
$string['doeditrole_label'] = 'Update';
$string['dodeleterole_label'] = 'Delete';
$string['deletequeditlink'] = 'Delete';
$string['editqueditlink'] = 'Edit';
$string['addqueditheading'] = 'Add quedit';
$string['deletequeditheading'] = 'Delete quedit: {$a}';
$string['editqueditheading'] = 'Edit quedit: {$a}';
$string['addroleheading'] = 'Add quedit member to: {$a}';
$string['deleteroleheading'] = 'Delete quedit member from: {$a}';
$string['deletedsuccessfully'] = 'The quedit was deleted successfully';
$string['failedtodelete'] = 'Failed to delete quedit. Sorry.';
$string['actions'] = 'Actions';
$string['activitytitle'] = 'Activity Title';
$string['nofamilies'] = 'No Families Found';
$string['invalidqueditid'] = 'Invalid Member ID specified';
$string['managefamilies'] = 'Manage quedit Activities';
$string['inadequatepermissions'] = 'Insufficient Permissions to Access this Page';
$string['managefamilies'] = 'Manage Questions';
$string['picture'] = 'Picture';
$string['fullname'] = 'Full Name';
$string['messagelink'] = 'message';
$string['editlink'] = 'edit';
$string['deletememberlink'] = 'delete';
$string['nochildren'] = 'quedit has no children';
$string['noparents'] = 'quedit has no parents';
$string['addparenttoquedit'] = 'Add parent to quedit';
$string['addchildtoquedit'] = 'Add child to quedit';
$string['invalidquedituserid'] = 'Invalid quedit or user id';
$string['queditnotes'] = 'quedit Notes';
$string['username'] = 'User Name';
$string['queditkey'] = 'quedit Key';
$string['potentialmembers'] = 'Potential Members';
$string['listall'] = 'List All Families';
$string['firstparentname'] = 'Parent Name';
$string['childrennames'] = 'Children Names';
$string['viewlink'] = 'view';
$string['addedmembersuccessfully'] = 'The quedit member was added successfully';
$string['deletedmembersuccessfully'] = 'The quedit member was deleted successfully';
$string['failedtodeletemember'] = 'Failed to delete quedit member. Sorry.';
$string['showsinglequedit'] = 'Showing quedit: {$a}';
$string['canceledbyuser'] = 'Canceled by user';
$string['dosearch'] = 'Find the quedit of the selected user';
$string['dosearch_label'] = 'Find the quedit of the selected user';
$string['undefined'] = '---';
$string['loginas'] = 'Login As';
$string['label_loginas'] = 'Login as Child';
$string['loginasheading'] = 'Login as user: {$a}';
$string['loginaserror'] = 'Unable to Login As Child';
$string['invalidparentid'] = 'Parent ID did not match quedit of Child';
$string['childistoopowerful'] = 'You can not login as this child. Their permissions are too great.';
$string['loginaswarning'] = 'You are about to login as another member of your quedit. <br />Please do not submit course activities on their behalf.';
$string['uploadfile'] = 'Upload a quedit defining a batch of quedit relationships';
$string['musthavefile'] = 'You must upload a file';
$string['uploadfileheading'] = 'Batch Upload quedit Definitions';
$string['uploadquestions'] = 'Batch Upload Question Edits';
$string['backtouploadquestions'] = 'Back to Batch Upload Questions';

$string['nopermission'] = 'You do not have permission to upload quedit relationships.';
$string['noroles'] = 'There are currently no roles assignable in User contexts. You must create such a role
before this block can be fully configured, otherwise you will not be able to use it!';
$string['reladded'] = '{$a->parent} sucessfully assigned to {$a->child}';
$string['relalreadyexists'] = '{$a->parent} already assigned to {$a->child}';
$string['reladderror'] = 'Error assigning {$a->parent} to {$a->child}';
$string['reldeleted'] = '{$a->parent} unassigned from {$a->child}';
$string['exportfamilies'] = 'Export families';
$string['toofewcols'] = 'Line {$a}: line has too few columns.';
$string['toomanycols'] = 'Line {$a}: line has too many columns.';
$string['parentnotfound'] = 'Line {$a}: Parent not found';
$string['childnotfound'] = 'Line {$a}: Child not found';
$string['wrongquedit'] = 'Line {$a}: Wrong quedit ';
$string['unabletoassignrole'] = 'Line {$a}: unable to Assign Role';
$string['alreadyindifferentquedit'] = 'Line {$a}: Already in another quedit';
$string['alreadyinquedit'] = 'Line {$a} Already in this quedit';
$string['nosuchuser'] = 'Line {$a}: No such user';
$string['nosuchquedit'] = 'Line {$a}: No such quedit';
$string['strangeuser'] = 'Line {$a}: Strange user';
$string['strangerow'] = 'Line {$a}: Strange row';
$string['strangerelationship'] = 'Line {$a}: Strange relationship ';
$string['notinquedit'] = 'Line {$a}: Not in quedit';
$string['wrongquedit'] = 'Line {$a}: Wrong quedit';
$string['unabletoremovemember'] = 'Line {$a}: unable to remove member from quedit';
$string['uploadfileresults'] = 'Results of File Upload';
$string['previewuploadfileresults'] = 'PREVIEW of File Upload';
$string['errorcount'] = 'Error Count: ';
$string['familiescreated'] = 'Families Created: ';
$string['queditcreationfailed'] = 'quedit Creation Failed: ';
$string['membersadded'] = 'quedit Members Added: ';
$string['membersremoved'] = 'quedit Members Removed: ';
$string['previewerrorcount'] = 'Preview Error Count: ';
$string['previewfamiliescreated'] = 'Families to be Created: ';
$string['previewmembersadded'] = 'quedit Members to be Added: ';
$string['previewmembersremoved'] = 'quedit Members to be Removed: ';
$string['importmode'] = 'Import Mode: ';
$string['previewmode'] = 'Preview Mode (no data is altered)';
$string['realmode'] = 'Execute Mode (no turning back)';
$string['stoponerror'] = 'Stop on error and return: ';
$string['importformat'] = 'Import Format';
$string['moodleformat'] = 'Moodle User Import Format(+ a few cols)';
$string['sameasexportformat'] = 'Same as quedit Export Format';

$string['nocol_username'] = 'No USERNAME column on line: {$a}';
$string['nocol_queditrole'] = 'No queditROLE column on line: {$a}';
$string['nocol_queditparent'] = 'No queditPARENT column on line: {$a}';
$string['nocol_queditkey'] = 'No queditKEY column on line: {$a}';
$string['noqueditkeyorsearchkey'] = 'Neither queditKEY column nor PARENTUSER specified on line: {$a}';
$string['bothqueditkeyandsearchkey'] = 'Both queditKEY column and PARENTUSER specified on line: {$a}. Please just use either but not both.';
$string['nosuchparentuser'] = 'The parent user specified does not exist line: {$a}';
$string['import_cancelled'] = 'quedit import cancelled due to incorrect/missing column definitions';
$string['import_cancelled_line'] = 'quedit import cancelled at line {$a} due to errors';