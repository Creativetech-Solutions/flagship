<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
error_reporting(E_ALL &~ E_DEPRECATED);
mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_touroperator ORDER BY tour_operator ASC";
$result = mysql_query($sql);

echo '<select class="form-control selector2" id="tour-oper" name="tour_oper">
      <option value="0">Select tour operator</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "' ".((isset($selectedTourOperator) and !empty($selectedTourOperator) and $selectedTourOperator==$row['id'])?' selected="selected"':'').">" . $row['tour_operator'] . "</option>";
}
echo "</select>";
?>