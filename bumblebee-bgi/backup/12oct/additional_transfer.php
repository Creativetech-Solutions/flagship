<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 12/1/2016
 * Time: 12:40 PM
 */
include ('../select.class.php');
if ($_POST) {
    $divID = $_POST['dataID'];
    $maxDivs = $_POST['max'];

    if(intval($divID)===(intval($maxDivs)-1)){
        $final = true;
    }else{
        $final = false;
    }

    if ($divID == 0) {
        $transfer_pickup = 'add_transfer_pickup';
        $transfer_pickup_time = 'add_transfer_pickup_time';
        $transfer_pickup_date = 'add_transfer_pickup_date';
        $transfer_transport = 'add_transfer_transport';
        $transfer_dropoff = 'add_transfer_dropoff';
        $transfer_driver = 'add_transfer_driver';
        $transfer_vehicle_no = 'add_transfer_vehicle_no';
        $transfer_notes = 'add_transfer_notes';
        $hiddenTransferInput = 'add_transfer_active';
    } else {
        $transfer_pickup = 'add_transfer_pickup' . $divID;
        $transfer_pickup_time = 'add_transfer_pickup_time' . $divID;
        $transfer_pickup_date = 'add_transfer_pickup_date' . $divID;
        $transfer_transport = 'add_transfer_transport' . $divID;
        $transfer_dropoff = 'add_transfer_dropoff' . $divID;
        $transfer_driver = 'add_transfer_driver' . $divID;
        $transfer_vehicle_no = 'add_transfer_vehicle_no' . $divID;
        $transfer_notes = 'add_transfer_notes' . $divID;
        $hiddenTransferInput = 'add_transfer'.$divID.'_active';
    }
}
?>
<div class="additional-transfer-div" id="additional-transfer-<?=$divID?>">
    <input type="hidden" id="<?=$hiddenTransferInput?>" name="<?=$hiddenTransferInput?>" value="1"/>
    <hr/>
    <h4>Concierge Transfer Details</h4>
    <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
        <label for="<?=$transfer_pickup?>">Pickup Location</label>
        <input type="text" class="form-control" id="<?=$transfer_pickup?>" name="<?=$transfer_pickup?>" />
    </div>
    <div class="form-group col-xs-3">
        <!-- arrival date -->
        <label for="<?=$transfer_pickup_date?>" class="left20">Pickup Date</label>
        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
            <input type="text" class="form-control datepicker" name="<?=$transfer_pickup_date?>" id="<?=$transfer_pickup_date?>"
                   placeholder="Pickup date"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-xs-2"><!-- pickup time -->
        <label for="<?=$transfer_pickup_time?>">Pickup Time</label>
        <div class="input-group bootstrap-timepicker">
            <input type="text" class="form-control timepicker24" name="<?=$transfer_pickup_time?>" id="<?=$transfer_pickup_time?>"
                   placeholder="Pickup time"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
        </div>
        <span class="help-block"> &nbsp;Select pickup time</span>
    </div>

    <div class="form-group col-xs-5"> <!-- transport mode field -->
        <label class="left20">Transport mode</label>
        <div class="left20">
            <?php
            $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
            $result = mysql_query($sql);
            echo '<select multiple class="form-control transport-mode" id="'.$transfer_transport.'" name="'.$transfer_transport.'[]">';
            while ($row = mysql_fetch_array($result)) {
                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
            }
            echo "</select>";
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-xs-7"><!-- dropoff location selection -->
        <label for="<?=$transfer_dropoff?>">Dropoff Location</label>
        <input type="text" class="form-control" id="<?=$transfer_dropoff?>" name="<?=$transfer_dropoff?>" placeholder="Dropoff Location">
    </div>
    <div class="clearfix"></div>
    <!-- initiate chained selection drivers -->
    <div class="form-group col-xs-4"><!-- available driver selection -->
        <label for="<?=$transfer_driver?>">Transport Supplier</label>
        <select class="form-control concerige-supplier" id="<?=$transfer_driver?>" name="<?=$transfer_driver?>">
            <?php echo $opt->ShowTransport(); ?>
        </select>
    </div>
    <div class="form-group col-xs-3"><!-- vehicle # selection -->
        <label for="<?=$transfer_vehicle_no?>" class="left20">Vehicle</label>
        <select class="form-control left20 concerige-vehicle" id="<?=$transfer_vehicle_no?>" name="<?=$transfer_vehicle_no?>">
            <option value="0">Select vehicle</option>
        </select>
    </div>

    <div class="form-group"><!-- hotel notes -->
        <div class="col-xs-7">
            <label>Concierge Notes</label>
            <textarea class="form-control text-lowercase" rows="5" id="<?=$transfer_notes?>" name="<?=$transfer_notes?>"
                      placeholder="Transfer &amp; Transportation notes: additional transfer &amp; transport comments and details here"></textarea>
        </div>
    </div>
    <div class="additionalTransferActionButtonsDiv">
        <button type="button" id="remAdditionalTransfer<?=!empty($divID)?'_'.$divID:''?>" class="btn btn-danger right20 remAdditionalTransfer">Remove Concierge Transfer</button>
        <?php
            if(!$final){
                ?>
                <button type="button" id="addAdditionalTransfer<?=!empty($divID)?'_'.$divID:''?>" class="btn btn-warning addAdditionalTransfer">Add Transfer</button>
        <?php
            }
        ?>

    </div>
</div>
<div class="clearfix"></div>