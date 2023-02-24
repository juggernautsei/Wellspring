<?php



function LBFTreatmentPlan_javascript_onload()
{
    $sql = "SELECT `short_term_goals_1`, `short_term_goals_2`, `short_term_goals_3` FROM `form_individual_treatment_plan` WHERE `pid` = ? ORDER  BY `id` DESC LIMIT 1";
    $results = sqlQuery($sql, [$_SESSION['pid']]);

    echo "
    function loadGoals() {
      document.getElementById('form_treatmentgoal1').value = '" . $results['short_term_goals_1']. "';
      document.getElementById('form_treatmentgoal2').value = '" . $results['short_term_goals_2']. "';
      document.getElementById('form_treatmentgoal3').value = '" . $results['short_term_goals_3']. "';
    }
    
    window.onload=loadGoals();
     ";
}