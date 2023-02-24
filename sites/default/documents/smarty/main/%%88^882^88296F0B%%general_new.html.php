<?php /* Smarty version 2.6.33, created on 2023-01-02 13:00:59
         compiled from /var/www/html/openemr/interface/forms/progress_note/templates/general_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 3, false),array('function', 'headerTemplate', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 4, false),array('function', 'xla', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 215, false),array('modifier', 'attr', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 34, false),array('modifier', 'date', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 39, false),array('modifier', 'text', '/var/www/html/openemr/interface/forms/progress_note/templates/general_new.html', 47, false),)), $this); ?>
<html>
<head>
<title><?php echo smarty_function_xlt(array('t' => 'Progress Note'), $this);?>
</title>
<?php echo smarty_function_headerTemplate(array('assets' => 'jquery-ui|jquery-ui-base|common|datetime-picker'), $this);?>

    <script>
        <?php echo '
        // handles the call back from the popup
        function set_related(codetype, code, selector, codedesc) {
            if (code) {
                if (codetype == \'ICD10\') {
                    document.getElementById(\'dxcode\').value += code + " - " + codedesc + " ,, \\r\\n";
                }
                if (codetype == \'CPT4\') {
                    document.getElementById(\'cpt4\').value += code + " - " + codedesc + " ,, \\r\\n";
                }
            }
        }
        // This invokes the find-code popup.
        function sel_diagnosis() {
            dlgopen(\'../../patient_file/encounter/find_code_popup.php?codetype=ICD10\', \'_blank\', 1024, 825);
        }
        function sel_code() {
            dlgopen(\'../../patient_file/encounter/find_code_popup.php?codetype=CPT4\',\'_blank\', 1024, 825);
        }
        '; ?>

    </script>
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2><?php echo smarty_function_xlt(array('t' => 'Progress Note'), $this);?>
</h2>
                <form name="soap" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
/interface/forms/progress_note/save.php" onsubmit="return top.restoreSession()">
                    <input type="hidden" name="csrf_token_form" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Date'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="datedata" class="form-control datepicker" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_datedata())) ? $this->_run_mod_handler('date', true, $_tmp) : date($_tmp)); ?>
" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Start Time'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="starttime" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_starttime())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'End Time'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="endtime" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_endtime())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Face to Face Time Spent'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="facetofacetime" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_facetofacetime())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            </div>
                        </div>
                    </fieldset>
                    <!--<fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Setting'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="setting" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_setting())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            </div>
                        </div>
                    </fieldset>-->
                    <!--<fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Mode'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="text" name="mode" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_mode())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            </div>
                        </div>
                    </fieldset>-->
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Attendant(s)'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <textarea type="text" name="attendant" class="form-control" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_attendant())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Focus of Session'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                              <!--  <input type="text" name="focusofsession" class="form-control" onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_focusofsession())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                            --></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => ''), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <input type="checkbox" name="ded" id="ded" onclick="checkVal('ded');" <?php echo $this->_tpl_vars['data']->get_dedchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo $this->_tpl_vars['data']->get_ded(); ?>
">
                                <label class="form-check-label" for="ded"> Decrease Emotional Disturbance</label><br>
                                <input type="checkbox" name="iicp" id="iicp" onclick="checkVal('iicp');" <?php echo $this->_tpl_vars['data']->get_iicpchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_iicp())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
"> 
                                <label class="form-check-label" for="iicp"> Increase Insight/Cognitive Patterns</label><br>
                                <input type="checkbox" name="iar" id="iar" onclick="checkVal('iar');" <?php echo $this->_tpl_vars['data']->get_iarchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_iar())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <label class="form-check-label" for="iar"> Improve Attachment Relationships</label><br>
                                <input type="checkbox" name="dtr" id="dtr" onclick="checkVal('dtr');" <?php echo $this->_tpl_vars['data']->get_dtrchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_dtr())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <label class="form-check-label" for="dtr"> Decrease Trauma Response</label><br>
                                <input type="checkbox" name="ppg" id="ppg" onclick="checkVal('ppg');" <?php echo $this->_tpl_vars['data']->get_ppgchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_ppg())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <label class="form-check-label" for="ppg"> Promote Personal Growth</label><br>
                                <input type="checkbox" name="pgal" id="pgal" onclick="checkVal('pgal');" <?php echo $this->_tpl_vars['data']->get_pgalchecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_pgal())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <label class="form-check-label" for="pgal"> Process Grief and Loss</label><br>
                                <input type="checkbox" name="bcs" id="bcs" onclick="checkVal('bcs');" <?php echo $this->_tpl_vars['data']->get_bcschecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_bcs())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <label class="form-check-label" for="bcs"> Building Coping Skills</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Goal Addressed'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <!--<input type="checkbox" name="goal1addressed" id="g1a" class="form-check-input" onclick="checkVal('g1a')" <?php echo $this->_tpl_vars['data']->get_g1achecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_g1a())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <input type="text" name="goaladdressed" class="form-control m-1"  onkeyup="top.isSoapEdit = true;" value = "<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL1'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
" placeholder="Goal 1">
                                <input type="checkbox" name="goal2addressed" id="g2a" class="form-check-input" onclick="checkVal('g2a')" <?php echo $this->_tpl_vars['data']->get_g2achecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_g2a())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <input type="text" name="goaladdressed2" class="form-control m-1"  onkeyup="top.isSoapEdit = true;" value = "<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed2())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL2'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
" placeholder="Goal 2">
                                <input type="checkbox" name="goal3addressed" id="g3a" class="form-check-input" onclick="checkVal('g3a')" <?php echo $this->_tpl_vars['data']->get_g3achecked(); ?>
 onkeyup="top.isSoapEdit = true;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_g3a())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
">
                                <input type="text" name="goaladdressed3" class="form-control m-1"  onkeyup="top.isSoapEdit = true;" value = "<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed3())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL3'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
" placeholder="Goal 3">
                                --><select name="goaladdressed" class="form-control">
                                    <option> ---- Select ---- </option>
                                    <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL1'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL1'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</option>
                                    <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL2'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL2'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</option>
                                    <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL3'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_goaladdressed())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['GOAL3'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Situation'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group"><p>**Situation. Use behavioral terms to describe client's (or caregiver's) current complaint or condition of client. May include new problems or how the client (or family) is progressing</p>
                                <textarea name="situation" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_situation())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['REASON'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Intervention'), $this);?>
</legend>
                        <div class="container"><p>**Must refer to the treatment goal and describe what you as the therapist did in the session (not what the client did in the session.) When applicable, it can be a risk assessment. Identify skills used to cope/adapt/respond/problem solve. Reinforce new behaviors, strengths. Identify specific skills that are taught/modeled/practiced</p>
                            <div class="form-group">
                                <textarea name="intevntion" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_intevntion())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Progress/Barrier Toward Goal'), $this);?>
  </legend>
                        <div class="container">
                            <div class="form-group"><p>**This is the client's response to the intervention(s). Explain if progress is made and what it is. Or describe the lack of progress and what are the barriers to be addressed to make progress.</p>
                                <textarea name="progressbarrier" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_progressbarrier())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Plan'), $this);?>
 </legend>
                        <div class="container"><p>**Follow up items, homework for the client, referrals to community resource.</p>
                            <div class="form-group">
                                <textarea name="plane" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_plane())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Diagnosis - More can be added, click the box to add additional diagnoses'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group">
                                <input type="text" name="dxcode" class="form-control" id="dxcode"  onclick="sel_diagnosis()" onkeyup="top.isSoapEdit = true;" value="<?php echo $this->_tpl_vars['DX_CODE']; ?>
">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Session'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group">
                                <select name="cpt4" class="form-control">
                                    <option>--- Select Session Type ---</option>
                                    <option value="90832 - 30 min individual psychotherapy with client and/or family member,,">Individual 60 min</option>
                                    <option value="90832 - 30 min individual psychotherapy with client and/or family member,,">Individual 30 min</option>
                                    <option value="90834 - 45 min individual psychotherapy with client and/or family member,,">Individual 45 min</option>
                                    <option value="90847 - Family therapy with client present (15 min increments),,">Family tx 15 min increments + Units</option>
                                    <option value="90846 - Family therapy without client present (15 min increments),,">Family tx without client + Units</option>
                                    <option value="90849 - Multi-family group psychotherapy (15 min increments),,">MultiFamily Group + Units</option>
                                </select>
                                <label for="units" class="mt-2">Enter # of Units - Default is 1</label>
                                <input type="text" class="form-control" id="units" name="units" value="1" title="Value should be at least one, change as needed">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary btn-save" name="Submit"><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</button>
                            <button type="button" class="btn btn-secondary btn-cancel" id="btnClose"><?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>
</button>
                        </div>
                        <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="activity" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_activity())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="pid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_pid())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="process" value="true" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    <?php echo '
        const close = function() {
            if (top.isSoapEdit === true) {
                dlgopen(\'\', \'\', 450, 125, \'\', \'<div class="text-danger">'; ?>
<?php echo smarty_function_xla(array('t' => 'Warning'), $this);?>
<?php echo '</div>\', {
                    type: \'Alert\',
                    html: \'<p>'; ?>
<?php echo smarty_function_xla(array('t' => 'Do you want to close the tabs?'), $this);?>
<?php echo '</p>\',
                    buttons: [
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Cancel'), $this);?>
<?php echo '\', close: true, style: \'default btn-sm\'},
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Close'), $this);?>
<?php echo '\', close: true, style: \'danger btn-sm\', click: closeSoap},
                    ],
                    allowDrag: false,
                    allowResize: false,
                });
            } else {
                top.restoreSession();
                location.href = \'javascript:parent.closeTab(window.name, false)\';
            }
        }

        const closeSoap = function() {
            top.isSoapEdit = false;
            top.restoreSession();
            location.href = \'javascript:parent.closeTab(window.name, false)\';
        }
        $(\'#btnClose\').click(close);
        function checkVal(id) {
            if (document.getElementById(id).checked) {
                document.getElementById(id).value = 1;
            } else {
                    document.getElementById(id).value = 0;
                }
            }

        $(function () {

            $(\'.datepicker\').datetimepicker({
            '; ?>
<?php  $datetimepicker = true;  ?>
                 <?php  $datetimepicker_showseconds = false;  ?>
                  <?php  $datetimepicker_formatInput = false;  ?>
                  <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
                  <?php  // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma  ?>
            });

        });
    </script>
</body>
</html>