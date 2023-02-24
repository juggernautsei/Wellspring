<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");



if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = formSubmit("form_individual_treatment_plan", $_POST, $_GET["id"], $userauthorized);

    addForm($encounter, "Individual Treatment Plan", $newid, "individual_treatment_plan", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    sqlStatement("update form_individual_treatment_plan set pid = ?, groupname = ?, user = ?, authorized = ?, activity=1, date = NOW(),
date_of_referal = ?,
dcn = ?,
icd9 = ?,
prognosis = ?,
diagnosis_description = ?,
presenting_problem = ?,
frequency = ?,
duration = ?,
short_goal1_date = ?,
short_term_goals_1 = ?,
short_goal1_current_behave = ?,
short_goal1_method_individual = ?,
short_goal1_method_family = ?,
short_goal1_method_group = ?,
short_goal1_method_parenting = ?,
short_goal1_frequency = ?,
short_goal1_duration = ?,
short_goal1_responsible = ?,
short_goal1_resolved = ?,
short_goal1_discontinued = ?,                                          
short_goal2_date = ?,
short_term_goals_2 = ?,
short_goal2_current_behave = ?,
short_goal2_method_individual = ?,
short_goal2_method_family = ?,
short_goal2_method_group = ?,
short_goal2_method_parenting = ?,
short_goal2_frequency = ?,
short_goal2_duration = ?,
short_goal2_responsible = ?,
short_goal2_resolved = ?,
short_goal2_discontinued = ?,
short_goal3_date = ?,
short_term_goals_3 = ?,
short_goal3_current_behave = ?,
short_goal3_method_individual = ?,
short_goal3_method_family = ?,
short_goal3_method_group = ?,
short_goal3_method_parenting = ?,
short_goal3_frequency = ?,
short_goal3_duration = ?,
short_goal3_responsible = ?,
short_goal3_resolved = ?,
short_goal3_discontinued = ? 
where id = ?", array(
        $_SESSION["pid"],
        $_SESSION["authProvider"],
        $_SESSION["authUser"],
        $userauthorized,
        $_POST["date_of_referal"],
        $_POST["dcn"],
        $_POST["icd9"],
        $_POST["prognosis"],
        $_POST["diagnosis_description"],
        $_POST["presenting_problem"],
        $_POST["frequency"],
        $_POST["duration"],
        $_POST["short_goal1_date"],
        $_POST["short_term_goals_1"],
        $_POST["short_goal1_current_behave"],
        $_POST["short_goal1_method_individual"],
        $_POST["short_goal1_method_family"],
        $_POST["short_goal1_method_group"],
        $_POST["short_goal1_method_parenting"],
        $_POST["short_goal1_frequency"],
        $_POST["short_goal1_duration"],
        $_POST["short_goal1_responsible"],
        $_POST["short_goal1_resolved"],
        $_POST["short_goal1_discontinued"],
        $_POST["short_goal2_date"],
        $_POST["short_term_goals_2"],
        $_POST["short_goal2_current_behave"],
        $_POST["short_goal2_method_individual"],
        $_POST["short_goal2_method_family"],
        $_POST["short_goal2_method_group"],
        $_POST["short_goal2_method_parenting"],
        $_POST["short_goal2_frequency"],
        $_POST["short_goal2_duration"],
        $_POST["short_goal2_responsible"],
        $_POST["short_goal2_resolved"],
        $_POST["short_goal2_discontinued"],
        $_POST["short_goal3_date"],
        $_POST["short_term_goals_3"],
        $_POST["short_goal3_current_behave"],
        $_POST["short_goal3_method_individual"],
        $_POST["short_goal3_method_family"],
        $_POST["short_goal3_method_group"],
        $_POST["short_goal3_method_parenting"],
        $_POST["short_goal3_frequency"],
        $_POST["short_goal3_duration"],
        $_POST["short_goal3_responsible"],
        $_POST["short_goal3_resolved"],
        $_POST["short_goal3_discontinued"],
        $_GET["id"])
    );
}

formHeader("Redirecting....");
formJump();
formFooter();
