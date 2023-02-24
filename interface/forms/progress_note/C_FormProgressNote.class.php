<?php

/**
 * soap form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once($GLOBALS['fileroot'] . "/library/forms.inc");
require_once("FormProgressNote.class.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Billing\AutoBilling;

class C_FormProgressNote extends Controller
{

    var $template_dir;
    var $goals;
    var $codingDone;

    function __construct($template_mod = "general")
    {
        $this->codingDone = new AutoBilling();
        parent::__construct();
        $this->goals = new FormProgressNote();

        $progressDate = $this->goals->getEncounterDate();
        $this->template_mod = $template_mod;
        $this->template_dir = dirname(__FILE__) . "/templates/";
        $this->assign("BILLING", $this->codingDone->hasBilling());
        $this->assign("FORM_ACTION", $GLOBALS['web_root']);
        $this->assign("DONT_SAVE_LINK", $GLOBALS['form_exit_url']);
        $this->assign("STYLE", $GLOBALS['style']);
        $this->assign("DX_CODE", $this->goals->getDx());

        $this->assign("DATE", $progressDate);
        $this->assign("CSRF_TOKEN_FORM", CsrfUtils::collectCsrfToken());
    }

    function default_action()
    {
        $form = new FormProgressNote();
        $giveReason = $this->goals->getReason();
        $this->assign("REASON", $giveReason['reason']);
        $setGoal = $this->goals->getTreatmentPlanGoals();
        $this->assign("GOAL1", $setGoal['short_term_goals_1']);
        $this->assign("GOAL2", $setGoal['short_term_goals_2']);
        $this->assign("GOAL3", $setGoal['short_term_goals_3']);
        $this->assign("data", $form);
        return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function view_action($form_id)
    {
        if (is_numeric($form_id)) {
            $form = new FormProgressNote($form_id);
        } else {
            $form = new FormProgressNote();
        }

        $this->assign("data", $form);

        return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function default_action_process()
    {
        if ($_POST['process'] != "true") {
            return;
        }
        $billing = new AutoBilling();
        error_log("Billing Passed into class " . $_POST['dxcode']);
        $billing->billingEntries($_POST['dxcode'], $_POST['cpt4'], $_POST['units']);

        $this->form = new FormProgressNote($_POST['id']);
        parent::populate_object($this->form);

        $this->form->persist();
        if ($GLOBALS['encounter'] == "") {
            $GLOBALS['encounter'] = date("Ymd");
        }

        if (empty($_POST['id'])) {
            addForm($GLOBALS['encounter'], "Prograss Note", $this->form->id, "progress_note", $GLOBALS['pid'], $_SESSION['userauthorized']);
            $_POST['process'] = "";
        }

        return;
    }
}
