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
$tblOperator = new ajaxCRUD("Operator",
                             "touroperator", "id");

# don't show the primary key in the table
$tblOperator->omitPrimaryKey();

# my db fields all have prefixes;
# display headers as reasonable titles
$tblOperator->displayAs("fldOper", "Tour Operator");

# add the filter box (above the table)
$tblOperator->addAjaxFilterBox("fldOper");

# actually show to the table
$tblOperator->showTable();

?>