<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

echo "<pre>";
$endData = [];
$endData["tx_plan_child"] = $_POST["tx_plan_child"];
$endData["txplanchild"] = $_POST["txplanchild"];
$endData["tx_plan_parent"] = $_POST["tx_plan_parent"];
$endData["txplanparent"] = $_POST["txplanparent"];
$endData["txplan_review"] = $_POST["txplan_review"];
$endData["dcsf_date_sent"] = $_POST["dcsf_date_sent"];
$saveEndData = json_encode($endData);


if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = formSubmit("form_individual_treatment_plan", $_POST, $_GET["id"], $userauthorized);

    addForm($encounter, "Individual Treatment Plan", $newid, "individual_treatment_plan", $pid, $userauthorized);
    miscDataSave($newid, $saveEndData);
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
    miscDataSave($_GET["id"], $saveEndData);
}

function miscDataSave($id, $data)
{
    $sql = "UPDATE `form_individual_treatment_plan` SET `misc_data` = ? WHERE `id` = ? ";
    sqlStatement($sql, [$data, $id]);
}

formHeader("Redirecting....");
formJump();
formFooter();
