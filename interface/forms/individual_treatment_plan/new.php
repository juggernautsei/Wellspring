<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");


use OpenEMR\Core\Header;

formHeader("Form: individual_treatment_plan");

?>
<html>

<head>
    <?php Header::setupHeader('datetime-picker', 'common'); ?>
    <script>
        // handles the call back from the popup
        function set_related(codetype, code, selector, codedesc) {
            if (code) {
                if (codetype == 'ICD10') {
                    document.getElementById('dxcode').value += code + " - " + codedesc + " ,, \r\n";
                }
                if (codetype == 'CPT4') {
                    document.getElementById('cpt').value += code + " - " + codedesc + " ,, \r\n";
                }
            }
        }
        // This invokes the find-code popup.
        function sel_diagnosis() {
            dlgopen('../../patient_file/encounter/find_code_popup.php?codetype=ICD10', '_blank', 1024, 825);
        }
        function sel_code() {
            dlgopen('../../patient_file/encounter/find_code_popup.php?codetype=CPT4','_blank', 1024, 825);
        }
        $(function () {
            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = false; ?>
                <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
                <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <form method=post action="<?php echo $rootdir; ?>/forms/individual_treatment_plan/save.php?mode=new" name="my_form">
            <br />
            <span class="title">
                <center>Individual Treatment Plan</center>
            </span><br /><br />
            <br />

            <?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = ?", array($pid));
            $result = SqlFetchArray($res); ?>

            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date Of Plan:</label>
                </div>
                <div class="col-md-10">
                    <input class='datepicker' type="text" name="date_of_referal" value="<?php echo text($result['date']); ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Client Name:</label>
                </div>
                <div class="col-md-10">
                    <label><?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']); ?></label>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Diagnosis:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="dcn" id="dxcode" size="150" value="" onclick="sel_diagnosis()" >
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Statement of conditions or problems that require skills development or mental health therapy:</label>
                </div>
                <div class="col-md-10">
                    <textarea cols=85 rows=5 wrap=virtual name="diagnosis_description"></textarea>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Discharge Planning (long-term goal):</label>
                </div>
                <div class="col-md-10">
                    <textarea cols=85 rows=3 wrap=virtual name="presenting_problem"></textarea>
                </div>
            </div>
            <h5 style="margin-left: 100px;margin-bottom: 30px;margin-top: 41px;">Short Term Goals</h5><hr>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                    <input class='datepicker' type="text" name="short_goal1_date" size="12" maxlength="10" value="" placeholder="yyyy-mm-dd">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 1:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="short_term_goals_1" size="120" maxlength="180" value="" placeholder="Enter Goal 1">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_current_behave" size="120" maxlength="180" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_individual" value=""><label style="padding-left: 10px;" for="short_goal1_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_family" value=""><label style="padding-left: 10px;" for="short_goal1_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_group" value=""><label style="padding-left: 10px;" for="short_goal1_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_parenting" value=""><label style="padding-left: 10px;" for="short_goal1_method_parenting">Parenting psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_frequency" size="12" maxlength="30" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_duration" size="12" maxlength="30" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_responsible" size="12" maxlength="30" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                    <input class='datepicker' type="text" name="short_goal1_resolved" size="12" maxlength="30" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                    <input class='datepicker' type="text" name="short_goal1_discontinued" size="12" maxlength="30" value="">
                </div>
            </div>
            <br>
            <br>
            <hr><!----  Section one above   ---->
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                <input class='datepicker' type="text" name="short_goal2_date" size="12" maxlength="30" value="">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 2:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_term_goals_2" size="120" maxlength="180" value="" placeholder="Enter Goal 2">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal2_current_behave" size="120" maxlength="180" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_individual" value=""><label style="padding-left: 10px;" for="short_goal2_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_family" value=""><label style="padding-left: 10px;" for="short_goal2_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_group" value=""><label style="padding-left: 10px;" for="short_goal2_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_parenting" value=""><label style="padding-left: 10px;" for="short_goal2_method_parenting">Parenting  psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_frequency" size="12" maxlength="55" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_duration" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_responsible" size="12" maxlength="50" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                <input class='datepicker' type="text" name="short_goal2_resolved" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                <input class='datepicker' type="text" name="short_goal2_discontinued" size="12" maxlength="50" value="">
                </div>
            </div>
            <br>

            <hr>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                <input type="text" class='datepicker' name="short_goal3_date" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 3:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_term_goals_3" size="120" maxlength="180" value="" placeholder="Enter Goal 3">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal3_current_behave" size="120" maxlength="180" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_individual" value=""><label style="padding-left: 10px;" for="short_goal3_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_family" value=""><label style="padding-left: 10px;" for="short_goal3_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_group" value=""><label style="padding-left: 10px;" for="short_goal3_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_parenting" value=""><label style="padding-left: 10px;" for="short_goal3_method_parenting">Parenting  psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_frequency" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_duration" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_responsible" size="12" maxlength="50" value="">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                <input class='datepicker' type="text" name="short_goal3_resolved" size="12" maxlength="50" value="">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                <input class='datepicker' type="text" name="short_goal3_discontinued" size="12" maxlength="50" value="">
                </div>
            </div>
            <br>

            <br /><br />
            <center><a class="btn btn-primary" href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
                <img src="<?php echo $GLOBALS['images_static_relative']; ?>/space.gif" width="5" height="1">
                <a class="btn btn-danger" href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link_submit" onclick="top.restoreSession()">[Don't Save]</a>
            </center>
            <br />
        </form>
    </div>
    <?php
    formFooter();
    ?>
