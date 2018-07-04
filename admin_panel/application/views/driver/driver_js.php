<?php ?>
<script>
  $(function () {
    
    var table = dataTableConfiguration();
    function delDriver(drId){
      var row=$('#data_list').find('tr[data-id="'+drId+'"]');
      $.ajax({
        url:"<?=base_url('driver/delDriver')?>",
        type:"POST",
        data:{drId:drId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            var dr_count = $('.dr-count').html();
                if($.isNumeric(dr_count) && dr_count>-1){
                  dr_count=parseInt(dr_count) - 1;
            }
             $('.dr-count').html(dr_count);

            notify(data[1], data[2]);
          }
          else {
            notify('Transport Supplier not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Transport Supplier not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del tour click function

     // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-driver'){
            delDriver(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

      // on open tour edit modal 
     $('#edit-driver').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) { 
          var drid=invoker.parents('.driver').attr('data-id');
          var dr_name=invoker.parents('.driver').find('.dr_name').html();
          var dr_name = dr_name.replace(/&amp;/g, '&');
          $(this).find('.driver_name').val(dr_name);
          $(this).find('.driver_id').val(drid);
          $(this).find('#tour_op_lbl').html('Edit Transport Supplier'); // set the modal title according to functionality
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-driver').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Transport Supplier'); // default title
    })
     // on save edit Driver
     $(document).on('click','.save-driver', function(){
        var parentMdl=$(this).parents('#edit-driver');
        var dr_name = parentMdl.find('.driver_name').val();
        var drId = parentMdl.find('.driver_id').val();
        // console.log(op_name+' dd'+opId);
        if(dr_name!=''){
          $.ajax({
            url:"<?=base_url('driver/saveDriver')?>",
            type:"POST",
            data:{drId:drId,dr_name:dr_name},
            beforeSend:function(){},
            success:function(data){
              parentMdl.modal('toggle');
              var data=data.split('::');
              if(data[2]=='success'){
                // if record updated
                if(data[3]=='update'){
                  $('.driver[data-id="'+drId+'"]').find('.dr_name').html(dr_name);
                }
                // if new record added
                else if(data[3]=='add'){
                  var record= JSON.parse(data[4]);
                  // update counter
                  var dr_count = $('.dr-count').html();
                    if($.isNumeric(dr_count) && dr_count>-1){ 
                      dr_count=parseInt(dr_count) + 1;
                    }
                    $('.dr-count').html(dr_count);
                  // data table add new row 
                  var rowNode = table.row.add( ['', '<span class="dr_name">'+record['name']+'</span> <a class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#vehicle_md">Vehicles<span class="badge">0</span></a>' ,'<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-driver"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-driver" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-driver"><i class="fa fa-trash"></i> Delete</a>', record['id_transport'] ] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id_transport'], 'class':'driver' } );
                    
                  //var table = dataTableConfiguration();
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Transport Supplier not updated. Try again','error');
              }
            },
            error:function(){
              notify('Transport Supplier not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else { // if input is empty
            notify('Transport Supplier Name is Required','error');
        }
     }) // end of save tour click function



     // get vehicle list by driver
     //$(document).on('click', '.dr_name', function(e){
      $('#vehicle_md').on('show.bs.modal', function (e) {
        var invoker = $(e.relatedTarget);
        var drId=invoker.parents('tr').attr('data-id'); 
        var dr_name=invoker.parents('tr').find('.dr_name').html();
        $(this).find('.dr-name').html(dr_name);
        $.ajax({
          url:"<?=base_url('driver/getVehicleByDrId')?>",
          type:"POST",
          data:{drId:drId},
          beforeSend:function(){},
          success:function(data){
            var data=data.split('::');
            if(data[2]=='success'){
                var vehicles=JSON.parse(data[3]);
                var htmlData='';
                $('.total-vehicle').find('.badge').html(vehicles.length);
                $.each(vehicles, function(i, val){
                   htmlData+='<li class="list-group-item bold">'+val.name+'</li>';
                })
                $('.vehicle-list').html(htmlData);
            }
            else {
              notify('Vehicles not found. Try again','error');
            }
          },
          error:function(){
            notify('Vehicles not found. Try again','error');
          }
      });// end of ajax
    })

       // on close vehicle_md modal
      $('#vehicle_md').on('hidden.bs.modal', function (e) { 
        $('.vehicle-list').empty();
      })

       // select2 place holder search by status
    $('#search_by_vehicle').select2({
       placeholder: "Search By Vehicle",
        allowClear: true
    }); 
      // search by vehicle 
    $('#search_by_vehicle').on('select2:select', function(e){
        var transportId=$(this).val();
        if(transportId!='' && transportId!='0'){
           $.ajax({
              url:"<?=base_url('driver/getDriverByVehicle')?>",
              type:"POST",
              data:{transportId:transportId},
              beforeSend:function(){},
              success:function(data){
                  $('.driverslist').html(data);
                  table = dataTableConfiguration();
              },
              error:function(){
                notify('Error Occur. Try again','error');
              }
          });// end of ajax
        }
    })


    // on unselect vehicle search 
    $('#search_by_vehicle').on('select2:unselect', function(e){
           $.ajax({
              url:"<?=base_url('driver/getDriverByVehicle')?>",
              beforeSend:function(){},
               success:function(data){
                  $('.driverslist').html(data);
                  table = dataTableConfiguration();
              },
              error:function(){
                notify('Error Occur. Try again','error');
              }
          });// end of ajax
    })


    function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    /*{
                      targets: 1,
                      className: 'dr_name'
                    },*/
                    {
                      targets: 2,
                      className: 'text-center'
                    },
                    {
                      targets: 3,
                      className: 'text-center'
                    },
                    {
                      targets: 4,
                      className: 'hidden'
                    }
                  ],
                  order:[[4, 'desc' ]]
    }
);
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    return table;
    }
  });
   
</script>