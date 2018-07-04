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
    if(!empty($_POST['arrID'])){
        $arrivalID = $_POST['arrID'];
    }

    $maxReached = false;
    if(intval($maxDivs)===($dataID)){
        $maxReached = true;
    }
}

?>

<div class="arr_transport_div" <?=($maxReached === true)?' style="margin-bottom:30px;overflow:hidden;"':''?>>
    <hr style="border: 1px solid #cccccc;">
<div class="form-group col-xs-7"> <!-- transport mode field -->
    <label for="arr<?=isset($arrivalID)?$arrivalID:''?>-transport">Transport mode</label>
    <?php
    echo '<select class="form-control select transport_mode" id="arr'.(isset($arrivalID)?$arrivalID:'').'-transport" required="required" name="arr'.(isset($arrivalID)?$arrivalID:'').'_transport[]">';
    include ('transport_mode_arr.php');
    echo "</select>";
    ?>
</div>
<div class="clearfix"></div>
<!-- initiate chained selection drivers -->
<div class="form-group col-xs-4"><!-- available driver selection -->
    <label for="arr<?=isset($arrivalID)?$arrivalID:''?>-driver">Transport Supplier</label>
    <select class="form-control arr_driver" id="arr<?=isset($arrivalID)?$arrivalID:''?>-driver" name="arr<?=isset($arrivalID)?$arrivalID:''?>_driver[]" disabled="disabled">
        <?php echo $opt->ShowTransport(); ?>
    </select>
</div>
<div class="form-group col-xs-3"><!-- vehicle # selection -->
    <label for="arr<?=isset($arrivalID)?$arrivalID:''?>-vehicle-no" class="left20">Vehicle</label>
    <select class="form-control left20 arr_vehicle" id="arr<?=isset($arrivalID)?$arrivalID:''?>-vehicle-no" name="arr<?=isset($arrivalID)?$arrivalID:''?>_vehicle_no[]" disabled="disabled">
        <option value="0">Select vehicle</option>
    </select>
</div>
    <div class="clearfix"></div>


        <div class="actionBtnsArrTransportDiv col-lg-7">
            <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                <a class="btn btn-default remArrTransportBtn" data-id="0"><i class="fa fa-minus"></i> Remove
                    Transport</a>
            </div>

            <?php
            //If Last Record We Don't Need Another Add Button.
            if ($maxReached !== true) {
            ?>
            <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                <a class="btn btn-default addArrTransportBtn left20" data-id="0"><i class="fa fa-plus"></i> Additional Arrival Transfer</a>
            </div>

            <?php
            }
            ?>
        </div>


</div>
<div class="clearfix"></div>
