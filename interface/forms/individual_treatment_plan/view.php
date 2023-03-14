<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");


use OpenEMR\Core\Header;

$obj = formFetch("form_individual_treatment_plan", $_GET["id"]);

?>
<html>

<head>
    <?php Header::setupHeader(); ?>
</head>

<body>
    <div class="container">
        <form method=post action="<?php echo $rootdir; ?>/forms/individual_treatment_plan/save.php?mode=update&id=<?php echo attr_url($_GET["id"]); ?>" name="my_form">
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
                    <input type="text" name="date_of_referal" value="<?php echo attr($obj["date_of_referal"]) ; ?>">
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
                    <input type="text" name="dcn" size="150" value="<?php echo attr($obj["dcn"]) ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">ICD/10/CM Code:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="icd9" value="<?php echo attr($obj['icd9']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Statement of conditions or problems that require skills development or mental health therapy:</label>
                </div>
                <div class="col-md-10">
                    <textarea cols=85 rows=5 wrap=virtual name="diagnosis_description"><?php echo attr($obj['diagnosis_description']);  ?></textarea>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Discharge Planning (long-term goal):</label>
                </div>
                <div class="col-md-10">
                    <textarea cols=85 rows=3 wrap=virtual name="presenting_problem"><?php echo attr($obj['presenting_problem']);  ?></textarea>
                </div>
            </div>
            <h5 style="margin-left: 100px;margin-bottom: 30px;margin-top: 41px;">Short Term Goals</h5><hr>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="short_goal1_date" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_date']);  ?>">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 1:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="short_term_goals_1" size="120" maxlength="180" value="<?php echo attr($obj['short_term_goals_1']);  ?>" placeholder="Enter Goal 1">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_current_behave" size="120" maxlength="180" value="<?php echo attr($obj['short_goal1_current_behave']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_individual" value="<?php echo attr($obj['short_goal1_method_individual']);  ?>"><label style="padding-left: 10px;" for="short_goal1_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_family" value="<?php echo attr($obj['short_goal1_method_family']);  ?>"><label style="padding-left: 10px;" for="short_goal1_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_group" value="<?php echo attr($obj['short_goal1_method_group']);  ?>"><label style="padding-left: 10px;" for="short_goal1_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal1_method_parenting" value="<?php echo attr($obj['short_goal1_method_parenting']);  ?>"><label style="padding-left: 10px;" for="short_goal1_method_parenting">Parenting psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_frequency" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_frequency']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_duration" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_duration']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_responsible" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_responsible']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_resolved" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_resolved']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="short_goal1_discontinued" size="12" maxlength="10" value="<?php echo attr($obj['short_goal1_discontinued']);  ?>">
                </div>
            </div>
            <br>
            <hr><!----  Section one above   ---->
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal2_date" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_date']);  ?>">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 2:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_term_goals_2" size="120" maxlength="180" value="<?php echo attr($obj['short_term_goals_2']);  ?>" placeholder="Enter Goal 2">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal2_current_behave" size="120" maxlength="180" value="<?php echo attr($obj['short_goal2_current_behave']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_individual" value="<?php echo attr($obj['short_goal2_method_individual']);  ?>"><label style="padding-left: 10px;" for="short_goal2_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_family" value="<?php echo attr($obj['short_goal2_method_family']);  ?>"><label style="padding-left: 10px;" for="short_goal2_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_group" value="<?php echo attr($obj['short_goal2_method_group']);  ?>"><label style="padding-left: 10px;" for="short_goal2_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal2_method_parenting" value="<?php echo attr($obj['short_goal2_method_parenting']);  ?>"><label style="padding-left: 10px;" for="short_goal2_method_parenting">Parenting  psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_frequency" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_frequency']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_duration" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_duration']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_responsible" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_responsible']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_resolved" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_resolved']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal2_discontinued" size="12" maxlength="10" value="<?php echo attr($obj['short_goal2_discontinued']);  ?>">
                </div>
            </div>
            <br>

            <hr>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-2">
                    <label style="font-weight: bold;">Date:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal3_date" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_date']);  ?>">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Goal 3:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_term_goals_3" size="120" maxlength="180" value="<?php echo attr($obj['Short_goal3']);  ?>" placeholder="Enter Goal 3">
                </div>
                <div class="col-md-2">
                    <label style="font-weight: bold;">Current Behavior Baseline:</label>
                </div>
                <div class="col-md-10">
                <input type="text" name="short_goal3_current_behave" size="120" maxlength="180" value="<?php echo attr($obj['short_goal3_current_behave']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Method:</label>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_individual" value="<?php echo attr($obj['short_goal3_method_individual']);  ?>"><label style="padding-left: 10px;" for="short_goal3_method_individual">Individual Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_family" value="<?php echo attr($obj['short_goal3_method_family']);  ?>"><label style="padding-left: 10px;" for="short_goal3_method_family">Family Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_group" value="<?php echo attr($obj['short_goal3_method_group']);  ?>"><label style="padding-left: 10px;" for="short_goal3_method_group">Group Therapy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" name="short_goal3_method_parenting" value="<?php echo attr($obj['short_goal3_method_parenting']);  ?>"><label style="padding-left: 10px;" for="short_goal3_method_parenting">Parenting  psychoed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Frequency:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_frequency" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_frequency']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Duration:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_duration" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_duration']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Responsible:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_responsible" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_responsible']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-1">
                    <label style="font-weight: bold;">Resolved Date:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_resolved" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_resolved']);  ?>">
                </div>
                <div class="col-md-1">
                    <label style="font-weight: bold;">Discontinued Date:</label>
                </div>
                <div class="col-md-2">
                <input type="text" name="short_goal3_discontinued" size="12" maxlength="10" value="<?php echo attr($obj['short_goal3_discontinued']);  ?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <table cellpadding="12px" class="table">
                    <tr>
                        <td>Consulted / reviewed the Tx plan review with child: </td>
                        <td>
                            <input type="radio" name="consult_tx_plan_child" value="yes"> Yes
                            <input type="radio" name="consult_tx_plan_child" value="no"> No</td>
                        <td>If no please explain: <input size="40" type="text" name="consult_txplanchild_explain"
                                                         value="<?php echo attr($obj['consult_txplanchild_explain']);  ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Consulted / reviewed the Tx plan review with parent/guardian: </td>
                        <td><input type="radio" name="consult_tx_plan_parent" value="yes"> Yes
                            <input type="radio" name="consult_tx_plan_parent" value="no"> No
                        </td>
                        <td>If no please explain:
                            <input size="40" type="text" name="consult_txplanparent_explain"
                                   value="<?php echo attr($obj['consult_txplanparent_explain']);  ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Consulted caseworker on Tx plan review: </td>
                        <td><input type="radio" name="consult_txplan_review_sent" value="yes" checked> Yes
                        </td>
                        <td>Copy sent to DCFS:
                            <input class='datepicker' type="text" name="dcsf_date_sent"
                                                      value="<?php echo attr($obj['dcsf_date_sent']);  ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>(Must be sent to DCFS caseworker within 15 days of completion)</strong></td>
                    </tr>
                </table>
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
