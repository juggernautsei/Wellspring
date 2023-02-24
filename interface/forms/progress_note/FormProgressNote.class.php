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

use OpenEMR\Common\ORDataObject\ORDataObject;

define("EVENT_VEHICLE", 1);
define("EVENT_WORK_RELATED", 2);
define("EVENT_SLIP_FALL", 3);
define("EVENT_OTHER", 4);


/**
 * class FormHpTjePrimary
 *
 */
class FormProgressNote extends ORDataObject
{

    /**
     *
     * @access public
     */


    /**
     *
     * static
     */
    var $id;
    var $date;
    var $pid;
    var $user;
    var $groupname;
    var $authorized;
    var $activity;

    var $datedata;
    var $starttime;
    var $endtime;
    var $facetofacetime;
    var $setting;
    var $mode;
    var $attendant;
    var $focusofsession;
    var $ded;
    var $iicp;
    var $iar;
    var $dtr;
    var $ppg;
    var $pgal;
    var $bcs;
    var $goaladdressed;
    var $goal1addressed;
    var $goaladdressed2;
    var $goal2addressed;
    var $goaladdressed3;
    var $goal3addressed;
    var $g1a;
    var $g2a;
    var $g3a;
    var $situation;
    var $intevntion;
    var $progressbarrier;
    var $plane;
    var $signaaturetitle;
    var $supervisorgignaturetitle;
    

    /**
     * Constructor sets all Form attributes to their default value
     */

    function __construct($id = "", $_prefix = "")
    {
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            $id = "";
            $this->date = date("Y-m-d H:i:s");
        }

        $this->_table = "form_progress_note";
        $this->activity = 1;
        $this->pid = $GLOBALS['pid'];
        if ($id != "") {
            $this->populate();
            //$this->date = $this->get_date();
        }
    }
    function populate()
    {
        parent::populate();
        //$this->temp_methods = parent::_load_enum("temp_locations",false);
    }

    function toString($html = false)
    {
        $string .= "\n"
            . "ID: " . $this->id . "\n";

        if ($html) {
            return nl2br($string);
        } else {
            return $string;
        }
    }
    function set_id($id)
    {
        if (!empty($id) && is_numeric($id)) {
            $this->id = $id;
        }
    }
    function get_id()
    {
        return $this->id;
    }
    function set_pid($pid)
    {
        if (!empty($pid) && is_numeric($pid)) {
            $this->pid = $pid;
        }
    }
    function get_pid()
    {
        return $this->pid;
    }
    function set_activity($tf)
    {
        if (!empty($tf) && is_numeric($tf)) {
            $this->activity = $tf;
        }
    }
    function get_activity()
    {
        return $this->activity;
    }

    function get_date()
    {
        return $this->date;
    }
    function set_date($dt)
    {
        if (!empty($dt)) {
            $this->date = $dt;
        }
    }
    function get_user()
    {
        return $this->user;
    }
    function set_user($u)
    {
        if (!empty($u)) {
            $this->user = $u;
        }
    }
    function get_datedata()
    {
        return $this->datedata;
    }
    function set_datedata($data)
    {
        if (!empty($data)) {
            $this->datedata = $data;
        }
    }
    function get_starttime()
    {
        return $this->starttime;
    }
    function set_starttime($data)
    {
        if (!empty($data)) {
            $this->starttime = $data;
        }
    }
    function get_endtime()
    {
        return $this->endtime;
    }
    function set_endtime($data)
    {
        if (!empty($data)) {
            $this->endtime = $data;
        }
    }
    function get_facetofacetime()
    {
        return $this->facetofacetime;
    }
    function set_facetofacetime($data)
    {
        if (!empty($data)) {
            $this->facetofacetime = $data;
        }
    }
    function get_setting()
    {
        return $this->setting;
    }
    function set_setting($data)
    {
        if (!empty($data)) {
            $this->setting = $data;
        }
    }
    function get_mode()
    {
        return $this->mode;
    }
    function set_mode($data)
    {
        if (!empty($data)) {
            $this->mode = $data;
        }
    }
    function get_attendant()
    {
        return $this->attendant;
    }
    function set_attendant($data)
    {
        if (!empty($data)) {
            $this->attendant = $data;
        }
    }
    function get_focusofsession()
    {
        return $this->focusofsession;
    }
    function set_focusofsession($data)
    {
        if (!empty($data)) {
            $this->focusofsession = $data;
        }
    }
    function get_ded()
    {
        return $this->ded;
    }
    function set_ded($data)
    {
        if (!empty($data)) {
            $this->ded = $data;
        }
    }
    function get_iicp()
    {
        return $this->iicp;
    }
    function set_iicp($data)
    {
        if (!empty($data)) {
            $this->iicp = $data;
        }
    }
    function get_iar()
    {
        return $this->iar;
    }
    function set_iar($data)
    {
        if (!empty($data)) {
            $this->iar = $data;
        }
    }
    function get_dtr()
    {
        return $this->dtr;
    }
    function set_dtr($data)
    {
        if (!empty($data)) {
            $this->dtr = $data;
        }
    }
    function get_ppg()
    {
        return $this->ppg;
    }
    function set_ppg($data)
    {
        if (!empty($data)) {
            $this->ppg = $data;
        }
    }
    function get_pgal()
    {
        return $this->pgal;
    }
    function set_pgal($data)
    {
        if (!empty($data)) {
            $this->pgal = $data;
        }
    }
    function get_bcs()
    {
        return $this->bcs;
    }
    function set_bcs($data)
    {
        if (!empty($data)) {
            $this->bcs = $data;
        }
    }

    /**
     * @return mixed
     */
    public function get_g1a()
    {
        return $this->g1a;
    }

    /**
     * @param mixed $g1a
     */
    public function set_g1a($data)
    {
        $this->g1a = $data;
    }

    /**
     * @return mixed
     */
    public function get_g2a()
    {
        return $this->g2a;
    }

    /**
     * @param mixed $g2a
     */
    public function set_g2a($data)
    {
        if (!empty($data)) {
            $this->g2a = $data;
        }
    }

    /**
     * @return mixed
     */
    public function get_g3a()
    {
        return $this->g3a;
    }

    /**
     * @param mixed $g3a
     */
    public function set_g3a($date)
    {
        if (!empty($data)) {
            $this->g3a = $data;
        }
    }
    function get_goaladdressed()
    {
        return $this->goaladdressed;
    }
    function set_goaladdressed($data)
    {
        if (!empty($data)) {
            $this->goaladdressed = $data;
        }
    }
    function get_goaladdressed2()
    {
        return $this->goaladdressed2;
    }
    function set_goaladdressed2($data)
    {
        if (!empty($data)) {
            $this->goaladdressed2 = $data;
        }
    }
    function get_goaladdressed3()
    {
        return $this->goaladdressed3;
    }
    function set_goaladdressed3($data)
    {
        if (!empty($data)) {
            $this->goaladdressed3 = $data;
        }
    }
    function get_situation()
    {
        return $this->situation;
    }
    function set_situation($data)
    {
        if (!empty($data)) {
            $this->situation = $data;
        }
    }
    function get_intevntion()
    {
        return $this->intevntion;
    }
    function set_intevntion($data)
    {
        if (!empty($data)) {
            $this->intevntion = $data;
        }
    }
    function get_progressbarrier()
    {
        return $this->progressbarrier;
    }
    function set_progressbarrier($data)
    {
        if (!empty($data)) {
            $this->progressbarrier = $data;
        }
    }
    function get_plane()
    {
        return $this->plan;
    }
    function set_plane($data)
    {
        if (!empty($data)) {
            $this->plan = $data;
        }
    }
    function get_signaaturetitle()
    {
        return $this->signaaturetitle;
    }
    function set_signaaturetitle($data)
    {
        if (!empty($data)) {
            $this->signaaturetitle = $data;
        }
    }
    function get_supervisorgignaturetitle()
    {
        return $this->supervisorgignaturetitle;
    }
    function set_supervisorgignaturetitle($data)
    {
        if (!empty($data)) {
            $this->supervisorgignaturetitle = $data;
        }
    }

    /**
     * @return mixed
     */
    public function get_goal1addressed()
    {
        return $this->goal1addressed;
    }

    /**
     * @param mixed $goal1addressed
     */
    public function set_goal1addressed($data)
    {
        if (!empty($data)) {
            $this->goal1addressed = $data;
        }
    }

    /**
     * @return mixed
     */
    public function get_goal2addressed()
    {
        return $this->goal2addressed;
    }

    /**
     * @param mixed $goal2addressed
     */
    public function set_goal2addressed($data)
    {
        if (!empty($data)) {
            $this->goal2addressed = $data;
        }
    }

    /**
     * @return mixed
     */
    public function get_goal3addressed()
    {
        return $this->goal3addressed;
    }

    /**
     * @param mixed $goal3addressed
     */
    public function set_goal3addressed($data)
    {
        if (!empty($data)) {
            $this->goal3addressed = $data;
        }
    }
    function get_dedchecked()
    {
        return $this->ded == 1 ? "checked" : "";
    }
    function get_iicpchecked()
    {
        return $this->iicp == 1 ? "checked" : "";
    }
    function get_iarchecked()
    {
        return $this->iar == 1 ? "checked" : "";
    }
    function get_dtrchecked()
    {
        return $this->dtr == 1 ? "checked" : "";
    }
    function get_ppgchecked()
    {
        return $this->ppg == 1 ? "checked" : "";
    }
    function get_pgalchecked()
    {
        return $this->pgal == 1 ? "checked" : "";
    }
    function get_bcschecked()
    {
        return $this->bcs == 1 ? "checked" : "";
    }
    function get_g1achecked()
    {
        return $this->g1a == 1 ? "checked" : "";
    }
    function get_g2achecked()
    {
        return $this->g2a == 1 ? "checked" : "";
    }
    function get_g3achecked()
    {
        return $this->g3a == 1 ? "checked" : "";
    }

    function persist()
    {
        parent::persist();
    }

    function getTreatmentPlanGoals()
    {
        $sql = "SELECT short_term_goals_1, short_term_goals_2, short_term_goals_3 FROM form_individual_treatment_plan WHERE pid = ? ORDER BY id DESC LIMIT 1";
        return sqlQuery($sql, [$_SESSION['pid']]);
    }
    function getReason()
    {
        $sql = "SELECT `reason` FROM `form_encounter` WHERE `encounter` = ?";
        return sqlQuery($sql, [$_SESSION['encounter']]);
    }

    function getEncounterDate()
    {
        $enc_date = $this->get_datedata();
        if (empty($enc_date)) {
            $sql = "SELECT date FROM `form_encounter` WHERE `encounter` = ?";
            $dateTime = sqlQuery($sql, [$_SESSION['encounter']]);
            $date = explode(" ", $dateTime['date']);
            return $date[0];
        } else {
           return '1975-07-04 ' . $enc_date;
        }

    }
    function getDx()
    {
        $sql = "SELECT dcn FROM `form_individual_treatment_plan` WHERE pid = 1  AND dcn != '' ORDER BY id DESC LIMIT 1";
        $dx_code = sqlQuery($sql);
        return $dx_code['dcn'];
    }
}   // end of Form
