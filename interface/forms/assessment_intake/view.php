<?php

/**
 * assessment_intake view.php.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    sunsetsystems <sunsetsystems>
 * @author    cornfeed <jdough823@gmail.com>
 * @author    fndtn357 <fndtn357@gmail.com>
 * @author    Robert Down <robertdown@live.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2005-2007 sunsetsystems <sunsetsystems>
 * @copyright Copyright (c) 2011 cornfeed <jdough823@gmail.com>
 * @copyright Copyright (c) 2012 fndtn357 <fndtn357@gmail.com>
 * @copyright Copyright (c) 2017 Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

// TODO: Code Cleanup

require_once("../../globals.php");
require_once("$srcdir/api.inc");


$obj = formFetch("form_assessment_intake", $_GET["id"]);
require_once "new.php";