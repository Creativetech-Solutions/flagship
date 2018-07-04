<?php
//Lets Check the Room Type.
if($_POST){
    $request = $_POST['req'];
    $roomCount = $_POST['dataID'];
    $arrID = $_POST['arrID'];

}
?>
<div class="clearfix"></div>
<div class="roomDiv">
<div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
    <label for="arr<?=$arrID?>_room_type<?=isset($roomCount)?$roomCount:''?>">Room type</label>
    <select class="form-control arr<?=$arrID?>_room_type right20 roomtype" id="arr<?=$arrID?>_room_type<?=isset($roomCount)?$roomCount:''?>" name="arr<?=$arrID?>_room_type<?=isset($roomCount)?$roomCount:''?>">
        <?php 
            if(!empty($_POST['locationid'])){
               include ('../select.class.php');
               echo $opt->ShowRoomType();

            }
        ?>
    </select>
</div>
<div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
    <label for="arr<?=$arrID?>_room-no<?=isset($roomCount)?$roomCount:''?>" class="right20">Room number</label>
    <input class="form-control right20" id="arr<?=$arrID?>_room-no<?=isset($roomCount)?$roomCount:''?>" name="arr<?=$arrID?>_room_no<?=isset($roomCount)?$roomCount:''?>" placeholder="Room number">
</div>
<div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;">
    <label for="arr<?=$arrID?>_room_last_name<?=isset($roomCount)?$roomCount:''?>">Last Name</label>
    <input type="text" class="form-control right20" id="arr<?=$arrID?>_room_last_name<?=isset($roomCount)?$roomCount:''?>" name="arr<?=$arrID?>_room_last_name<?=isset($roomCount)?$roomCount:''?>" placeholder="Guest last name">
</div>
<div class="form-group col-lg-3 actionButtons" style="margin-top: 21px;">
    <a class="btn btn-default removeBtn" data-id="<?=$arrID?>"><i class="fa fa-minus"></i> Remove Room</a>
    <a class="btn btn-default addRoomBtn" data-id="<?=$arrID?>"><i class="fa fa-plus"></i> Add Room</a>
</div>
</div>