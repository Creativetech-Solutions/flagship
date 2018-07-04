<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 12/2/2016
 * Time: 11:06 AM
 */
include ('../select.class.php');
error_reporting(E_ALL ^ E_DEPRECATED);

if($_POST){
    $dataID = intval($_POST['dataID'])+1;
    $maxDivs = $_POST['max'];
    if(!empty($_POST['dptID'])){
        $dptID = $_POST['dptID'];
    }

    $maxReached = false;
    if(intval($maxDivs)===($dataID)){
        $maxReached = true;
    }
}

?>

<div class="dpt_transport_div transport-div" <?=($maxReached === true)?' style="margin-bottom:30px;overflow:hidden;"':''?>>
    <hr style="border: 1px solid #cccccc;">
<div class="form-group col-xs-7"> <!-- transport mode field -->
    <label for="dpt<?=isset($dptID)?$dptID:''?>-transport">Transport mode</label>
    <?php
    echo '<select class="form-control select transport_mode" id="dpt'.(isset($dptID)?$dptID:'').'-transport" required="required" name="dpt'.(isset($dptID)?$dptID:'').'_transport[]">';
    include ('transport_mode_arr.php');
    echo "</select>";
    ?>
</div>
<div class="clearfix"></div>
<!-- initiate chained selection drivers -->
<div class="form-group col-xs-4"><!-- available driver selection -->
    <label for="dpt<?=isset($dptID)?$dptID:''?>-driver">Transport Supplier</label>
    <select class="form-control dpt_driver driver" id="dpt<?=isset($dptID)?$dptID:''?>-driver" name="dpt<?=isset($dptID)?$dptID:''?>_driver[]" disabled="disabled">
        <?php echo $opt->ShowTransport(); ?>
    </select>
</div>
<div class="form-group col-xs-3"><!-- vehicle # selection -->
    <label for="dpt<?=isset($dptID)?$dptID:''?>-vehicle-no" class="left20">Vehicle</label>
    <select class="form-control left20 dpt_vehicle vehicle" id="dpt<?=isset($dptID)?$dptID:''?>-vehicle-no" name="dpt<?=isset($dptID)?$dptID:''?>_vehicle_no[]" disabled="disabled">
        <option value="0">Select vehicle</option>
    </select>
</div>
    <div class="clearfix"></div>


        <div class="actionBtnsDptTransportDiv col-lg-7">
            <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                <a class="btn btn-default remDptTransportBtn" data-id="0"><i class="fa fa-minus"></i> Remove
                    Transport</a>
            </div>

            <?php
            //If Last Record We Don't Need Another Add Button.
            if ($maxReached !== true) {
            ?>
            <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                <a class="btn btn-default addDptTransportBtn left20" data-id="0"><i class="fa fa-plus"></i> Additional Departure Transfer</a>
            </div>

            <?php
            }
            ?>
        </div>


</div>
<div class="clearfix"></div>
