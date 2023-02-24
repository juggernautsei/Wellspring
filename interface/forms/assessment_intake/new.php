<?php

/**
 * assessment_intake new.php.
 *
 * @package OpenEMR
 * @linkhttp://www.open-emr.org
 * @author Brady Miller <brady.g.miller@gmail.com>
 * @author Tyler Wrenn <tyler@tylerwrenn.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2020 Tyler Wrenn <tyler@tylerwrenn.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once "$srcdir/patient.inc";
require_once "$srcdir/options.inc.php";

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

formHeader("Form: assessment_intake");

if (empty($_GET['id'])) {
    $mode = 'new';
} else {
    $mode = 'update';
}


?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo xlt("Mental Health Assessment "); ?></title>
    <?php Header::setupHeader(['common', 'datetime-picker']); ?>
    <script>
        let dcn_field = '';

        // This invokes the find-code popup.
        function sel_diagnosis(dcn) {
              dcn_field = dcn;
            dlgopen('../../patient_file/encounter/find_code_popup.php?codetype=ICD10', '_blank', 1024, 825);
        }
        // handles the call back from the popup
        function set_related(codetype, code, selector, codedesc) {
            if (code) {
                if (codetype == 'ICD10') {
                    document.getElementById(dcn_field).value += code + " - " + codedesc + " ,, \r\n";
                }
            }
        }
    </script>
    <script>

        $(function () {
            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = false; ?>
                <?php require $GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'; ?>
            });
        });
    </script>
</head>

<body class="m-0 body_top">
    <div class="container">
        <form method="post" action="<?php echo $rootdir;?>/forms/assessment_intake/save.php?mode=<?php echo $mode; ?>" name="my_form">
            <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
            <input type="hidden" name="id" value="<?php echo $obj['id'] ;?>" />
            <br />
            <h3 class="title text-center">Mental Health Assessment</h3>
            <div class="text-center">
                <a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary"><?php echo xlt("Save"); ?></a>
                <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()"><?php echo xlt("Don't Save"); ?></a>
            </div>
            <br />

            <?php
            $res = sqlStatement("SELECT 
            fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB,
            genericname1 as School,
            genericval1 as Grade,
            genericname2 as Examiner,
            genericval2 as Supervisor
             FROM patient_data WHERE pid = ?", array($pid));
            $result = SqlFetchArray($res);
            $dobYMD = $result['DOB'];
            $age = getPatientAge($dobYMD);
            ?>

            <p><label class="font-weight-bold">Name:</label>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?></p>
            <p><label class="font-weight-bold"><?php echo xlt('Age'); ?>:</label> <?php echo $age; ?></p>
            <div class="form-group ml-2">
                <label class="font-weight-bold">Initial MH assessment date:</label>
                <input type="text" class='datepicker' name="initial_date" id="initial_date" value="<?php echo xlt($obj['initial_date']); ?>"><input class="m-2" type="text" name="initial_units" value="<?php echo xlt($obj['initial_units']); ?>" placeholder="Units">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Subsequent date:</label>
                <input type="text" class='datepicker' name="subsequent_date1" id="subsequent_date1" value="<?php echo xlt($obj['subsequent_date1']); ?>" ><input class="m-2" type="text" name="subsequent_units1" value="<?php echo xlt($obj['subsequent_units1']); ?>" placeholder="Units">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Subsequent date:</label>
                <input type="text" class='datepicker' name="subsequent_date2" id="subsequent_date2" value="<?php echo xlt($obj['subsequent_date2']); ?>" ><input class="m-2" type="text" name="subsequent_units2" value="<?php echo xlt($obj['subsequent_units2']); ?>" placeholder="Units">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Subsequent date:</label>
                <input type="text" class='datepicker' name="subsequent_date3" id="subsequent_date3" value="<?php echo xlt($obj['subsequent_date3']); ?>" ><input class="m-2" type="text" name="subsequent_units3" value="<?php echo xlt($obj['subsequent_units3']); ?>" placeholder="Units">
            </div>

            <!--<p><label class="font-weight-bold">SSN:</label>&nbsp;<?php echo text($result['ss']);?></p>-->

            <!--<div class="form-group">
                <label class="font-weight-bold" for="location">Location:</label>
                <input type="text" class="form-control" name="location" id="location" value="<?php echo xlt($obj['location']); ?>"/>
            </div>-->

            <p><label class="font-weight-bold">Address:</label>&nbsp; <?php echo text($result['city']) . ',&nbsp' . text($result['state']) . '&nbsp;' . text($result['postal_code']);?></p>

            <p><label class="font-weight-bold">Telephone Number:</label>&nbsp; <?php echo text($result['phone_home']);?></p>

            <p><label class="font-weight-bold">Date of Birth:</label>&nbsp;<?php echo text($result['DOB']);?></p>
            <p><label class="font-weight-bold">School:</label>&nbsp;<?php echo text($result['School']);?></p>

            <div class="form-group">
                <label class="font-weight-bold">Referral Source:</label>
                <input type="text" class="form-control" name="referral_source" value="<?php echo xlt($obj['referral_source']); ?>"/>
            </div>

	    <div class="form-group">
	        <label class="font-weight-bold">Identifying Information (living situation, if client is in custody, those living in the home, and accompanied by)</label>
	        <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="identifying_info"><?php echo xlt($obj['identifying_info']); ?></textarea>
	    </div>	
            
            <div class="form-group">
                <label class="font-weight-bold">Reason for Referral</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="reason_why"><?php echo xlt($obj['reason_why']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Chief Complaint (in client’s and guardians’ own words)</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="chief_complaint"><?php echo xlt($obj['chief_complaint']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Description and History of Presenting Problem:</label>
                <textarea class="form-control" cols="100" rows="5" wrap="virtual" name="behavior_led_to"><?php echo xlt($obj['behavior_led_to']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Other Psychosocial History and Current Concerns:</label>
                <textarea class="form-control" cols="100" rows="5" wrap="virtual" name="other_psyc"><?php echo xlt($obj['other_psyc']); ?></textarea>
            </div>

            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;">Social History:</h5>

            <div class="form-group">
                <label class="font-weight-bold">School Functioning (special education, school performance, problems, strengths, history):</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="school_work"><?php echo xlt($obj['school_work']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Family Environment (parents’ employment, daycare or after school program, finances, stressors, religious background, methods of discipline, family social network):</label>
                <textarea class="form-control" cols="100" rows="4" wrap="virtual" name="personal_relationships"><?php echo xlt($obj['personal_relationships']); ?></textarea>
            </div>

            <p class="font-weight-bold">Family Relationships</p>
            <div>
                <div class="custom-control">
                    <input type="checkbox" class="form-check-input" name='fatherc' value="Yes" <?php if ($obj['fatherc'] == 1) { echo 'checked'; } ?>/>
                    <label class="font-weight-bold ">Father involved/present/absent (Describe relationship with bio, foster, adopted as applicable)</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="father_involved"><?php echo xlt($obj['father_involved']); ?></textarea>
                </div>
            </div>
            <div>
                <div class="custom-control">
                    <input type="checkbox" class="form-check-input" name='motherc' value="Yes"/>
                    <label class="font-weight-bold ">Mother involved/present/absent (Describe relationship with bio, foster, adopted as applicable)</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="mother_involved"><?php echo xlt($obj['mother_involved']); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Number of siblings:</label>
                <input type="text" class="form-control" name="number_children" value="<?php echo xlt($obj['number_children']); ?>"/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Names, ages, quality of relationship(s):</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="siblings"><?php echo xlt($obj['siblings']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Other family relationships:</label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="other_relationships"><?php echo xlt($obj['other_relationships']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Social and Peer Functioning (Peers/Friends):</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="social_relationships"><?php echo xlt($obj['social_relationships']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Self-Care Skills/Issues (including toileting concerns if applicable) :</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="current_symptoms"><?php echo xlt($obj['current_symtoms']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Personal Resources and Strengths:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="personal_strengths"><?php echo xlt($obj['personal_strengths']); ?></textarea>
            </div>

            <!--<div class="form-group">
                <label class="font-weight-bold">Spiritual:</label>
                <input type="text" class="form-control" name="spiritual" value="<?php echo xlt($obj['spiritual']); ?>"/>
            </div>-->

            <div class="form-group">
                <label class="font-weight-bold">Legal/Criminal History and Current Status:</label>
                <input type="text" class="form-control" name="legal" value="<?php echo xlt($obj['legal']); ?>"/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Previous Treatment and Medical History/Concerns: (mental health, counseling, hospital admissions, residential/day tx, suicide attempts, psychotropic medications, medical illnesses, medications, chronic conditions, allergies to medication)</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="prior_history"><?php echo xlt($obj['prior_history']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Mental Status Exam (e.g. appearance, activity level, eye contact, cooperativeness, language, affect/mood, attention span, adaptability, thought process/play content, response to challenges, self-confidence, interactions with caregiver)</label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="ax4_other"><?php echo xlt($obj['ax4_other']); ?></textarea>
            </div>
            <!--<div class="form-group">
                <label class="font-weight-bold">Number of admissions:</label>
                <input type="text" class="form-control" name="number_admitt" value="<?php echo xlt($obj['number_admitt']); ?>"/>
            </div>-->

            <!--<div class="form-group">
                <label class="font-weight-bold">Types of admissions:</label>
                <input type="text" class="form-control" name="type_admitt" value="<?php echo xlt($obj['type_admitt']); ?>"/>
            </div>-->

            <div class="form-group">
                <label class="font-weight-bold">Drug/Substance and Alcohol Use (past and present):</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="substance_use"><?php echo xlt($obj['substance_use']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Family Psychiatric History :</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="substance_abuse"><?php echo xlt($obj['substance_abuse']); ?></textarea>
            </div>

            <!--<p class="font-weight-bold">Psychosocial and environmental problems in the last year:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_prob_support_group' value="Yes" <?php echo ($obj['ax4_prob_support_group'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Problems with primary support group</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_prob_soc_env' value="Yes" <?php echo ($obj['ax4_prob_soc_env'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Problems related to the social environment</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_educational_prob' value="Yes" <?php echo ($obj['ax4_educational_prob'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Educational problems</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_occ_prob' value="Yes" <?php echo ($obj['ax4_occ_prob'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Occupational problems</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_housing' value="Yes" <?php echo ($obj['ax4_housing'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Housing problems</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_economic' value="Yes" <?php echo ($obj['ax4_economic'] == 'Yes' ? "checked" : ""); ?> />
                <label class="font-weight-bold form-check-label">Economic problems</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_access_hc' value="Yes" <?php echo ($obj['ax4_economic'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Problems with access to health care services</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='ax4_legal' value="Yes" <?php echo ($obj['ax4_legal'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Problems related to interaction with the legal system/crime</label>
            </div>
            <div >
                <div >
                    <input type="checkbox" class="form-check-input" name='ax4_other_cb'  value="Yes" <?php echo ($obj['ax4_other_cb'] == 'Yes' ? "checked" : ""); ?>/>
                    <label class="font-weight-bold form-check-label">Other (specify):</label>
                </div>-->
            <div >

            </div>

            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;">Assessment of Currently Known Risk Factors:</h5>

            <p class="font-weight-bold">Suicide:</p>
            
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_na' value="Yes" <?php echo ($obj['risk_suicide_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_na' value="Yes" <?php echo ($obj['risk_homocide_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">No suicidality reported</label>
            </div>

            <!--<p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_nk' value="Yes" <?php echo ($obj['risk_suicide_nk'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Known</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_io' value="Yes" <?php echo ($obj['risk_suicide_io'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Ideation only</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_plan' value="Yes" <?php echo ($obj['risk_suicide_plan'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Plan</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_iwom' value="Yes" <?php echo ($obj['risk_suicide_iwom'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Intent without means</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_suicide_iwm' value="Yes" <?php echo ($obj['risk_suicide_iwm'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Intent with means</label>
            </div>-->

            <!--<p class="font-weight-bold mt-3">Homocide:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_na' value="Yes" <?php echo ($obj['risk_homocide_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>-->

            <!--<p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_nk' value="Yes" <?php echo ($obj['risk_homocide_nk'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Known</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_io' value="Yes" <?php echo ($obj['risk_homocide_io'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Ideation only</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_plan' value="Yes" <?php echo ($obj['risk_homocide_plan'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Plan</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_iwom' value="Yes" <?php echo ($obj['risk_homocide_iwom'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Intent without means</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_homocide_iwm' value="Yes" <?php echo ($obj['risk_homocide_iwm'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Intent with means</label>
            </div>-->

            <!--<p class="font-weight-bold mt-3">Compliance with treatment:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_na' value="Yes" <?php echo ($obj['risk_compliance_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>-->

            <!--<div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_fc' value="Yes" <?php echo ($obj['risk_compliance_fc'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Full compliance</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_mc' value="Yes" <?php echo ($obj['risk_compliance_mc'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Minimal compliance</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_moc' value="Yes" <?php echo ($obj['risk_compliance_moc'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Moderate compliance</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_var' value="Yes" <?php echo ($obj['risk_compliance_var'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Variable</label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_compliance_no' value="Yes" <?php echo ($obj['risk_compliance_no'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Little or no compliance</label>
            </div>-->

            <!--<p class="font-weight-bold mt-3">Substance Abuse:</p>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_na' value="Yes" <?php echo ($obj['risk_substance_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_na' value="Yes" <?php echo ($obj['risk_suicidality_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">No suicidality</label>
            </div>
            <div >
                <div>
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_substance_none' value="Yes" <?php echo ($obj['risk_substance_none'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">None/normal use:</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="risk_normal_use"><?php echo $obj['risk_normal_use']; ?></textarea>
                </div>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_ou' value="Yes" <?php echo ($obj['risk_substance_ou'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Overuse</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_dp' value="Yes" <?php echo ($obj['risk_substance_dp'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Dependence</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_ur' value="Yes" <?php echo ($obj['risk_substance_ur'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Unstable remission of abuse</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_ab' value="Yes" <?php echo ($obj['risk_substance_oab'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Abuse</label>
            </div>-->

            <p class="font-weight-bold mt-3">Physical or sexual abuse:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_na' value="Yes" <?php echo ($obj['risk_sexual_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_ab' value="Yes" <?php echo ($obj['risk_substance_oab'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">None Reported</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_y' value="Yes" <?php echo ($obj['risk_sexual_y'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Yes</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_n' value="No" <?php echo ($obj['risk_sexual_na'] == 'No' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">No</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_n' value="maybe" <?php echo ($obj['risk_sexual_maybe'] == 'maybe' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Suspected/Maybe</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_substance_ur' value="Yes" <?php echo ($obj['risk_substance_ur'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Past abuse reported</label>
            </div>

            <p class="font-weight-bold mt-3">Has been reported?</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_ry' value="Yes" <?php echo ($obj['risk_sexual_ry'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Yes</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_rn' value="Yes" <?php echo ($obj['risk_sexual_rn'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">No</label>
            </div>

            <p class="font-weight-bold mt-3">If yes, client is </p>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_cv' value="Yes" <?php echo ($obj['risk_sexual_cv'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">victim</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_cp' value="Yes" <?php echo ($obj['risk_sexual_cp'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">perpetrator</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_b' value="Yes" <?php echo ($obj['risk_sexual_b'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Both</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_sexual_nf' value="Yes" <?php echo ($obj['risk_sexual_nf'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Witnessed domestic violence/Suspected of witnessing domestic violence</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_ry' value="Yes" <?php echo ($obj['risk_neglect_ry'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("Yes"); ?></label><br>
                <input type="text" class="form-control w-100" name="abusername" placeholder="Abusers name" >
            </div>

            <!--<p class="font-weight-bold mt-3">Current child/elder abuse:</p>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_na' value="Yes" <?php echo ($obj['risk_neglect_na'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_y' value="Yes" <?php echo ($obj['risk_neglect_y'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">Yes</label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_n' value="Yes" <?php echo ($obj['risk_neglect_n'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label">No</label>
            </div>

            <label class="font-weight-bold mt-3">Legally reportable?</label>
            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_ry' value="Yes" <?php echo ($obj['risk_neglect_ry'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("Yes"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_rn' value="Yes" <?php echo ($obj['risk_neglect_rn'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("No"); ?></label>
            </div>

            <p class="font-weight-bold mt-3"><?php echo xlt("If yes, client is "); ?></p>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_cv' value="Yes" <?php echo ($obj['risk_neglect_cv'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("victim"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_cp' value="Yes" <?php echo ($obj['risk_neglect_cp'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("perpetrator"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_cb' value="Yes" <?php echo ($obj['risk_neglect_cb'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("Both"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='risk_neglect_cn' value="Yes" <?php echo ($obj['risk_neglect_cn'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label"><?php echo xlt("neither, but abuse exists in family"); ?></label>
            </div>

            <div class="row align-items-center">
                <div class="col-2">
                    <p class="font-weight-bold">If risk exists the client:</p>
                </div>
                <div class="col-4">
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_exists_c' id='risk_exists_c' value="Yes" <?php echo ($obj['risk_exists_c'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">can meaningfully agree to a contract not to harm</label>
                    </div>
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_exists_cn' id='risk_exists_cn' value="Yes" <?php echo ($obj['risk_exists_cn'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">cannot meaningfully agree to a contract not to harm</label>
                    </div>
                </div>
                <div class="col-2">
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_exists_s' value="Yes" <?php echo ($obj['risk_exists_s'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">self</label>
                    </div>
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_exists_o' value="Yes" <?php echo ($obj['risk_exists_o'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">others</label>
                    </div>
                    <div >
                        <input type="checkbox" class="form-check-input" name='risk_exists_b' value="Yes" <?php echo ($obj['risk_exists_b'] == 'Yes' ? "checked" : ""); ?>/>
                        <label class="font-weight-bold form-check-label">both</label>
                    </div>
                </div>
            </div>-->
<br><br>
            <div class="form-group">
                <label class="font-weight-bold">Disposition/Plan Details:</label>
                <textarea class="form-control" id="dcn1" cols="100" rows="3" wrap="virtual" name="dispositionplan" ><?php echo xlt($obj['dispositionplan']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Initial Formulation and Diagnostic Impression:</label>
                <textarea class="form-control" id="dcn1" cols="100" rows="3" wrap="virtual" name="risk_community" ><?php echo xlt($obj['risk_community']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="dcn">Diagnosis 1:</label>
                <input type="text" class="form-control" name="dcn1" id="dcn1" onclick="sel_diagnosis('dcn1')" value="" readonly/>
                <label class="font-weight-bold" for="dcn">Diagnosis 2:</label>
                <input type="text" class="form-control" name="dcn2" id="dcn2" onclick="sel_diagnosis('dcn2')" value="" readonly/>
                <label class="font-weight-bold" for="dcn">Diagnosis 3:</label>
                <input type="text" class="form-control" name="dcn3" id="dcn3" onclick="sel_diagnosis('dcn3')" value="" readonly/>
                <label class="font-weight-bold" for="dcn">Diagnosis 4:</label>
                <input type="text" class="form-control" name="dcn4" id="dcn4" onclick="sel_diagnosis('dcn4')" value="" readonly/>
            </div>

            <!--<div class="form-group">
                <label class="font-weight-bold">Date report sent to DCFS caseworker. Must be sent within 15 days of completion:</label>
                <input type="text" class="form-control datepicker" name='refer_date' value="<?php echo xlt($obj['refer_date']); ?>"/>
            </div>-->

            <div class="form-group">
                <label class="font-weight-bold">Parent/Guardian:</label>
                <input type="text" class="form-control" name='parent' value="<?php echo xlt($obj['parent']); ?>"/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="supervision_level">Level of supervision needed:</label>
                <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="supervision_level" id="supervision_level"><?php echo xlt($obj['supervision_level']); ?></textarea>
            </div>

            <!--<div class="form-group">
                <label class="font-weight-bold" for="supervision_type">Type of program:</label>
                <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="supervision_type" id="supervision_type"><?php echo xlt($obj['supervision_type']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="supervision_res"><?php echo xlt("Residential or long-term placement recommended:"); ?></label>
                <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="supervision_res" id="supervision_res"><?php echo xlt($obj['supervision_res']); ?></textarea>
            </div>-->

            <div class="form-group">
                <label class="font-weight-bold" for="supervision_services"><?php echo xlt("Support services needed:"); ?></label>
                <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="supervision_services" id="supervision_services"><?php echo xlt($obj['supervision_services']); ?></textarea>
            </div>
            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;">Assessment Recommendations:</h5>

            <p class="font-weight-bold">Outpatient Psychotherapy Recommendations:</p>
            <div class="custom-control">
                <input type="checkbox"  name='recommendations_psy_i' value="Yes" <?php echo ($obj['recommendations_psy_i'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold ">Individual</label>
            </div>

            <div class="custom-control ">
                <input type="checkbox"  name='recommendations_psy_f' value="Yes" <?php echo ($obj['recommendations_psy_f'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold ">Family</label>
            </div>

            <div class="custom-control ">
                <input type="checkbox"  name='recommendations_psy_m' value="Yes" <?php echo ($obj['recommendations_psy_m'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold ">Group</label>
            </div>

            <div>
                <div class="custom-control">
                    <input type="checkbox"  name='recommendations_psy_o' value="Yes" <?php echo ($obj['recommendations_psy_o'] == 'Yes' ? "checked" : ""); ?>/>
                    <label class="font-weight-bold ">Other</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="recommendations_psy_notes"><?php echo xlt($obj['recommendations_psy_notes']); ?></textarea>
                </div>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='support_ps' id='support_ps' value="Yes" <?php echo ($obj['support_ps'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="support_ps"><?php echo xlt("Parenting skills/child management"); ?></label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='support_cs' id='support_cs' value="Yes" <?php echo ($obj['support_cs'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="support_cs"><?php echo xlt("Communication skills"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='support_sm' id='support_sm' value="Yes" <?php echo ($obj['support_sm'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="support_sm"><?php echo xlt("Stress management"); ?></label>
            </div>

            <div >
                <input type="checkbox" class="form-check-input" name='support_a' id='support_a' value="Yes" <?php echo ($obj['support_a'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="support_a"><?php echo xlt("Assertiveness"); ?></label>
            </div>

            <div >
                <div >
                    <input type="checkbox" class="form-check-input" name='support_o' id='support_o' value="Yes" <?php echo ($obj['support_o'] == 'Yes' ? "checked" : ""); ?>/>
                    <label class="font-weight-bold form-check-label" for="support_o"><?php echo xlt("Other"); ?></label>
                </div>
                <div class="ml-1">
                    <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="support_ol" id="support_ol"><?php echo xlt($obj['support_ol']); ?></textarea>
                </div>
            </div>

            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;"><?php echo xlt("Legal Services:"); ?></h5>
            <div >
                <input type="checkbox" class="form-check-input" name='legal_op' id='legal_op' value="Yes" <?php echo ($obj['legal_op'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="legal_op"><?php echo xlt("Offender program"); ?></label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='legal_so' id='legal_so' value="Yes" <?php echo ($obj['legal_so'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="legal_so"><?php echo xlt("Sex Offender Groups"); ?></label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='legal_sa' id='legal_sa' value="Yes" <?php echo ($obj['legal_sa'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="legal_sa"><?php echo xlt("Substance abuse"); ?></label>
            </div>
            <div >
                <input type="checkbox" class="form-check-input" name='legal_ve' id='legal_ve' value="Yes" <?php echo ($obj['legal_ve'] == 'Yes' ? "checked" : ""); ?>/>
                <label class="font-weight-bold form-check-label" for="legal_ve"><?php echo xlt("Victim empathy group"); ?></label>
            </div>
            <div >
                <div >
                    <input type="checkbox" class="form-check-input" name='legal_ad' id='legal_ad' value="Yes" <?php echo ($obj['legal_ad'] == 'Yes' ? "checked" : ""); ?>/>
                    <label class="font-weight-bold form-check-label" for="legal_ad"><?php echo xlt("Referral to advocate"); ?></label>
                </div>
                <div>
                    <input type="text" class="form-control" name='legal_adl' value="<?php echo xlt($obj['legal_adl']); ?>"/>
                </div>
            </div>
            <div >
                <div >
                    <input type="checkbox" class="custom-control-input" name='legal_o' id="legal_o" value="Yes" <?php echo ($obj['legal_o'] == 'Yes' ? "checked" : ""); ?>/>
                    <label class="font-weight-bold form-check-label" for="legal_o"><?php echo xlt("Other:"); ?></label>
                </div>
                <div class="ml-1">
                    <textarea class="form-control" cols="100" rows="1" wrap="virtual" name="legal_ol" id="legal_ol"><?php echo xlt($obj['legal_ol']); ?></textarea>
                </div>
            </div>

            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;"><?php echo xlt("Referrals for Continuing Services"); ?></h5>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_pepm"><?php echo xlt("Psychiatric Evaluation Psychotropic Medications:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_pepm" id="referrals_pepm"><?php echo xlt($obj['referral_pepm']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold"><?php echo xlt("Medical Care:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_mc" id="referrals_mc"><?php echo xlt($obj['referral_mc']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_vt"><?php echo xlt("Educational/vocational services:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_vt" id="referrals_vt"><?php echo xlt($obj['referral_vt']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_o"><?php echo xlt("Other:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_o" id="referrals_o"><?php echo xlt($obj['referral_0']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_cu"><?php echo xlt("Current use of resources/services from other community agencies:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_cu" id="referrals_cu"><?php echo xlt($obj['referral_cu']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_docs"><?php echo xlt("Documents to be obtainded (Release of Information Required):"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_docs" id="referrals_docs"><?php echo xlt($obj['referral_docs']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="referrals_or"><?php echo xlt("Other needed resources and services:"); ?></label>
                <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="referrals_or" id="referrals_or"><?php echo xlt($obj['referral_or']); ?></textarea>
            </div>
            

            <div class="form-row">
                <div class="col-7 mb-3">
                    <label class="font-weight-bold" for="cpt4"><?php echo xlt('CPT4') ?>:</label>
                    <input type="text" class="form-control" name="cpt4" placeholder="CPT4" value="90791 - Mental Health Diagnostic Evaluation by Mental Health Therapist (15 min increments),," readonly/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-7">
                    <input type="text" class="form-control" name="copy_sent_to" placeholder="Sent Copy to" value="<?php echo xlt($obj['copy_sent_to']);?>"/>
                </div>
                <div class="col">
                    <input type="text" class="form-control datepicker" name="date_copy_sent" placeholder="Date Copy must be Sent within 15 days" value="<?php echo xlt($obj['date_copy_sent']); ?>"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col mt-3">
                    <input type="checkbox" class="form-check-input" name="completed" value="yes">
                    <label class="font-weight-bold form-check-label" for="complete"><?php echo xlt("Is ready for billing"); ?></label>
                </div>
            </div>
            <div class="text-center" style="padding-top: 15px">
                <a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary"><?php echo xlt("Save"); ?></a>
                <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()"><?php echo xlt("Don't Save"); ?></a>
            </div>
            <br />
            <!--

            -->
        </form>
    </div>
    <?php
    formFooter();
    ?>
