<?php
$postedReq = $_POST['req'];
if ($postedReq === 'guestCount') {
    $dataID = $_POST['dataID'];

    $count = intval($dataID)+1;
    ?>


    <!-- guests 1-->
    <div class="guestShow" data-position="<?=$count?>">
        <input type="hidden" id="guest1active" name="guest1active" value="0"/>
        <h5>Guest Details</h5>
        <div class="form-group">
            <div class="form-inline col-xs-12"><!-- guest first name / guest last name fields -->
                <label class="left20">First name</label> <input type="text" class="form-control right20 text-capitalize"
                                                                placeholder="First name" id="guest-first-name"
                                                                name="guest_first_name[]" value="">
                <label>Last name</label> <input type="text" class="form-control right20 text-capitalize"
                                                placeholder="Last name" id="guest-last-name" name="guest_last_name[]"
                                                value="">
                <label>PNR</label> <input type="text" class="form-control" placeholder="Guest PNR" id="guest-pnr"
                                          name="guest_pnr[]" value="">
                <div class="form-group col-xs-2">
                    <select class="form-control select" id="guest-title-name1" name="guest_title_name[]">
                        <option value="">Select title</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Ms</option>
                        <option>Miss</option>
                        <option>Master</option>
                        <option>Dr</option>
                        <option>Sir</option>
                        <option>Lord</option>
                        <option>Lady</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
                                    <!-- <div class="form-group">
                                        <div class="form-inline col-xs-12">
                                            <label>Guest Cell</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Guest Cell" id="guest-cell" name="guest_cell[]" value="" autocomplete="off">
                                            <label>Guest Email</label> <input type="text" class="form-control right20" placeholder="Guest Email" id="guest-email" name="guest_email[]" value="" autocomplete="off">
                                        </div>
                                    </div>  --> 
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="form-inline col-xs-8 guest-fields"><!-- guest first name / guest last name fields -->
                <label class="checkbox-inline right20 label_checkboxitem">
                    <input type="checkbox" id="guest-adult1" name="guest_adult[]"> Adult
                </label>
                <input type="number" min=12 max=17 class="form-control" id="teen_age1" name="teen_age[]" value="" placeholder="Teen - 12 yrs - 17 yrs"> Years
                <input type="number" min=0 max=11 class="form-control" id="child_age1" name="child_age[]" value="" placeholder="Child - 13 months - 11 yrs"> Years
                <input type="number" min=0 max=23 class="left20 form-control" id="infant_age1" name="infant_age[]"
                       value="" placeholder="Infant - 12 months or less"> Months
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-danger right20 removeGuest">Remove Guest</button>
            <button type="button" class="btn btn-warning addGuest">Add Guest</button>
        </div>
        <div class="clearfix"></div>
        <hr/>
    </div>
    <!-- end guest 1 -->


<?php
}
?>