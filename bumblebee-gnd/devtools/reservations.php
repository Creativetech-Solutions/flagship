<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

# include this file at the very top of your script
require_once('preheader.php');

# the code for the class
include ('ajaxCRUD.class.php');

# this one line of code is how you implement the class
$tblRes = new ajaxCRUD("Reservations",
                             "reservations", "id");

# don't show the primary key in the table
$tblRes->omitPrimaryKey();

# my db fields all have prefixes;
# display headers as reasonable titles
$tblRes->displayAs("fldRes", "First Name");
$tblRes->displayAs("fldRes", "Last Name");

# add the filter box (above the table)
$tblRes->addAjaxFilterBox("fldRes");

# actually show to the table
$tblRes->showTable();

?>