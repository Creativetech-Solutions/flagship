<?php ?>
<script>
  $(function () {
    var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: 'hidden'
                    },
                    {
                      targets: 2,
                      className: 'vehicle_name'
                    },
                    {
                      targets: 3,
                      className: 'driver_name'
                    },
                    {
                      targets: 4,
                      className: 'text-center'
                    },
                    {
                      targets: 5,
                      className: 'text-center'
                    }
                  ],
                  order:[[1, 'desc' ]]
    }
);
table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


     function delVehicle(vehicleId){
      var row=$('#data_list').find('tr[data-id="'+vehicleId+'"]');
      $.ajax({
        url:"<?=base_url('vehicle/delVehicle')?>",
        type:"POST",
        data:{vehicleId:vehicleId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            var vehicle_count = $('.vehicle-count').html();
            if($.isNumeric(vehicle_count) && vehicle_count>0){
              vehicle_count=parseInt(vehicle_count) - 1;
            }
             $('.vehicle-count').html(vehicle_count);
            notify(data[1], data[2]);
          }
          else {
            notify('Vehicle not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Vehicle not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del tour click function

     // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-vehicle'){
            delVehicle(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })


      // on open tour edit modal 
     $('#edit-vehicle').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var vehicle_id=invoker.parents('.vehicle').attr('data-id');
          var vehicle_name=invoker.parents('.vehicle').find('.vehicle_name').html();
          var vehicle_name = vehicle_name.replace(/&amp;/g, '&');
          $(this).find('.vehicle_name').val(vehicle_name);
          $(this).find('.vehicle_id').val(vehicle_id);
          $(this).find('#tour_op_lbl').html('Edit Vehicle'); // set the modal title according to functionality
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-vehicle').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Vehicle'); // default title
    })
     // on save edit tour operator
     $(document).on('click','.save-vehicle', function(){
        var parentMdl=$(this).parents('#edit-vehicle');
        var vehicle_name = parentMdl.find('.vehicle_name').val();
        var transportId=parentMdl.find('.transporter').val();
        var vehicleId = parentMdl.find('.vehicle_id').val();
        console.log(vehicle_name+' dd'+vehicleId);
        if(vehicle_name!=''){
          $.ajax({
            url:"<?=base_url('vehicle/saveVehicle')?>",
            type:"POST",
            data:{vehicleId:vehicleId,vehicle_name:vehicle_name,transportId:transportId},
            beforeSend:function(){},
            success:function(data){
              parentMdl.modal('toggle');
              var data=data.split('::');
              if(data[2]=='success'){
                var record= JSON.parse(data[4]);
                // if record updated
                if(data[3]=='update'){
                  $('.vehicle[data-id="'+vehicleId+'"]').find('.vehicle_name').html(record['vehicle']);
                  $('.vehicle[data-id="'+vehicleId+'"]').find('.driver_name').html(record['driver']);
                  $('.vehicle[data-id="'+vehicleId+'"]').attr('data-dr-id',record['id_transport']);
                }
                // if new record added
                else if(data[3]=='add'){
                  // update counter
                  var vehicle_count = $('.vehicle-count').html();
                    if($.isNumeric(vehicle_count) && vehicle_count>-1){
                      vehicle_count=parseInt(vehicle_count) + 1;
                    }
                  $('.vehicle-count').html(vehicle_count);
                  // data table add new row 
                  var rowNode = table.row.add( [ '', record['id_vehicle'], record['vehicle'] ,record['driver'], '<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-vehicle"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-vehicle" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-vehicle"><i class="fa fa-trash"></i> Delete</a>' ] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id_vehicle'], 'class':'vehicle', 'data-dr-id':record['id_transport'] } );
                    
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Vehicle not updated. Try again','error');
              }
            },
            error:function(){
              notify('Vehicle not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else { // if input is empty
            notify('Vehicle Name is Required','error');
        }
     }) // end of save tour click function

  // get vehicles list on select2 dropdown open
  var vehicles = $(".select2 .vehicle-list");
  vehicles.select2();
  $(".select2.vehicle-list").on("select2:open", function (e) {  
      getData('vehicles');
  });

  // set vehicles list in dropdown
  function setVehiclesList(records){ 
    var htmldata='';
    $.each(records, function(i, val){
       htmldata+='<option value="'+val.id_vehicle+'">'+val.name+'</option>';
    })
    $('.select2.vehicle-list').append(htmldata);
  }

  // drivers
  $(".select2.drivers-list").on("select2:open", function (e) {  
      getData('transport');
  });

  // set vehicles list in dropdown
  function setTransportList(records){ 
    var htmldata='';
    $.each(records, function(i, val){
       htmldata+='<option value="'+val.id_transport+'">'+val.name+'</option>';
    })
    $('.select2.drivers-list').append(htmldata);
  }

  function getData(tbl){
    $.ajax({
      url:"<?=base_url('vehicle/getData')?>",
      type:"POST",
      data:{tbl:tbl},
      beforeSend:function(){},
      success:function(data){
        var data=data.split("::");
        if(data[2]=='success'){
            var records=JSON.parse(data[3]);
            if(tbl=='vehicles'){ 
              setVehiclesList(records);
            } else if(tbl=='transport'){
              setTransportList(records);
            }
        }
      },
      error:function(){}

    })
  }

  // on select vehicle name
  $(".select2.vehicle-list").on("select2:select", function (e) {  
      var vehicleId=$(".select2.vehicle-list").val();
      $.ajax({
        url:"<?=base_url('vehicle/getVehicleById')?>",
        type:"POST",
        data:{vehicleId:vehicleId},
        beforeSend:function(){},
        success:function(data){
          $('.vehicles-list').html(data);
        },
        error:function(){}
     })
  });

  // on select driver name
   $(".select2.drivers-list").on("select2:select", function (e) {  
      var driverId=$(".select2.drivers-list").val();
      $.ajax({
        url:"<?=base_url('vehicle/getVehicleByDriverId')?>",
        type:"POST",
        data:{driverId:driverId},
        beforeSend:function(){},
        success:function(data){
          $('.vehicles-list').html(data);
        },
        error:function(){}
     })
  });
   // search by vehicle
    $('#search_by_vehicle').keyup(function(){
        table.column(2).search($(this).val()).draw() ;
    })
   // search by driver
    $('#search_by_driver').keyup(function(){
        table.column(3).search($(this).val()).draw() ;
    })
  });
</script>