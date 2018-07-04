<?php ?>
<script>
  $(function () {
    var table=dataTableConfiguration();

    function delRoomType(roomId){
      var row=$('#data_list').find('tr[data-id="'+roomId+'"]');
      $.ajax({
        url:"<?=base_url('roomtype/delRoomType')?>",
        type:"POST",
        data:{roomId:roomId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            var room_count = $('.room-count').html();
            if($.isNumeric(room_count) && room_count>0){
              room_count=parseInt(room_count) - 1;
            }
             $('.room-count').html(room_count);
            notify(data[1], data[2]);
          }
          else {
            notify('Room Type not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Room Type not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del flight function

      // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-roomtype'){
            delRoomType(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

      // on open tour edit modal 
     $('#edit-roomtype').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var roomId=invoker.parents('.room').attr('data-id');
          var locId=invoker.parents('.room').attr('data-loc-id');
          var roomtype=invoker.parents('.room').find('.room__type').html();
          var roomtype = roomtype.replace(/&amp;/g, '&');
          $(this).find('.room__type').val(roomtype);
          $(this).find('.roomtypeId').val(roomId);
          $(this).find('#tour_op_lbl').html('Edit Room Type'); // set the modal title according to functionality
         // $(this).find('.locations').find('option[value="'+roomId+'"]').prop('selected',true);
          $("#selectId").val(locId).trigger('change');
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-roomtype').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Room Type'); // default title
    })
     // on save 
     $(document).on('click','.save-roomtype', function(){
        var parentMdl=$(this).parents('#edit-roomtype');
        var roomtype = parentMdl.find('.room__type').val();
        var roomtypeId = parentMdl.find('.roomtypeId').val();
       // var locId = parentMdl.find('.locations').val();
        console.log(roomtype+' dd'+roomtypeId);
        if(roomtype!=''){
          $.ajax({
            url:"<?=base_url('roomtype/saveRoomtype')?>",
            type:"POST",
            data:{roomtypeId:roomtypeId,roomtype:roomtype},
            beforeSend:function(){},
            success:function(data){
              var data=data.split('::');
              if(data[2]=='success'){
                // close modal
                parentMdl.modal('toggle');

                  var record= JSON.parse(data[4]);
                // if record updated
                if(data[3]=='update'){
                  $('.room[data-id="'+record['id_room']+'"]').find('.room__type').html(roomtype);
                 // $('.room[data-id="'+record['id_room']+'"]').attr('data-loc-id', record['id_location']);
                }
                // if new record added
                else if(data[3]=='add'){
                  // update counter
                  var room_count = $('.room-count').html();
                    if($.isNumeric(room_count) && room_count>-1){
                      room_count=parseInt(room_count) + 1;
                    }
                    $('.room-count').html(room_count);
                  // data table add new row 
                  var rowNode = table.row.add(['', record['room_type'] ,'<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-roomtype"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-roomtype" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-roomtype"><i class="fa fa-trash"></i> Delete</a>',record['id_room']] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id_room'], 'class':'room' } );
                    
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Room Type not updated. Try again','error');
              }
            },
            error:function(){
              notify('Room Type not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else { // if input is empty
          notify('Room Type is Required','error');
        }
     }) // end of save tour click function

  <?php // on flight timing modal opens, get time and display in modal ?>
  
    function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: 'room__type'
                    },
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

    $('#search_by_roomtype').keyup(function(){
        table.column(1).search($(this).val()).draw() ;
    })
        return table;
    }

   /* // fetch time value on change timepicker input
   $('.timepicker').timepicker().on('changeTime.timepicker', function(e) {
    console.log('From:'+ $('.timepicker.from').val());
    console.log('To ' + $('.timepicker.to').val());
  });*/

// get locations list on load
  window.onload=function(){
    $.ajax({
      url:"<?=base_url('roomtype/getLocationsList')?>",
      success:function(data){
        var data=data.split('::');
        if(data[2]=='success'){
          var locations=JSON.parse(data[3]);
          if(typeof locations !='undefined' && locations.length>0){
            
            $("#search_by_loc").select2({
                data: locations,
                placeholder: "Select a state",
                allowClear: true
              })
          } // end of if
        } // end of if
      } // end of success
    })
  }

  // on select location
  $('#search_by_loc').on('select2:select', function(){
    var locId=$(this).val();
      $.ajax({
        url:"<?=base_url('Roomtype/getRoomTypeByLocId')?>",
        data:{locId:locId},
        type:"POST",
        success:function(data){
          $('.roomtypelist').html(data);
           var table=dataTableConfiguration();
        }
      })
  })

  // on unselect location
  $('#search_by_loc').on('select2:unselect', function(){
      $.ajax({
        url:"<?=base_url('Roomtype/getRoomTypeByLocId')?>",
        success:function(data){
           $('.roomtypelist').html(data);
            var table=dataTableConfiguration();
        }
      })
  })
  });

</script>