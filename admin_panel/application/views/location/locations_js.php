<script>
    $(function () {
        var table=dataTableConfiguration();
 // save location
     $(document).on('click','.save-loc', function(){
        var parentMdl=$(this).parents('#edit-loc');
        var loc_name = parentMdl.find('.loc_name').val();
        var loc_zone = parentMdl.find('.loc_zone').val();
        var loc_code = parentMdl.find('.loc_code').val();
        var loc_id = parentMdl.find('.loc_id').val();
        // console.log(op_name+' dd'+opId);
        if(loc_name==''){
          notify('Location Name is Required','error');
        } else if(loc_zone==''){
          notify('Zone is Required','error');
        } else if(loc_code==''){
          notify('Location Code is Required', 'error');
        } 
        else {
          $.ajax({
            url:"<?=base_url('location/saveLocation')?>",
            type:"POST",
            data:{loc_name:loc_name,loc_zone:loc_zone,loc_id:loc_id, loc_code:loc_code},
            beforeSend:function(){},
            success:function(data){
              parentMdl.modal('toggle');
              var data=data.split('::');
              if(data[2]=='success'){
                var record= JSON.parse(data[4]);
                // if record updated
                console.log(record['zone']);
                if(data[3]=='update'){
                  $('#data_list').find('tr[data-id="'+record['id_location']+'"]').children('td').eq(1).html(record['name']);
                   $('#data_list').find('tr[data-id="'+record['id_location']+'"]').children('td').eq(2).html(record['loc_code']);
                   $('#data_list').find('tr[data-id="'+record['id_location']+'"]').children('td').eq(3).html(record['coast']);
                  

                }
                // if new record added
                else if(data[3]=='add'){  
                  var loc_count = $('.loc-count').html();
                    if($.isNumeric(loc_count) && loc_count>-1){
                      loc_count=parseInt(loc_count) + 1;
                    }
                    $('.loc-count').html(loc_count);
                  // data table add new row 
                  var rowNode = table.row.add(['', record['name'], record['loc_code'],record['coast'],
                    '<a data-target="#roomtypes" data-toggle="modal" class="btn btn-success btn-xs roomtypes">Room Types</a>','<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-loc"><i data-toggle="tooltip" title="Edit" class=" ml-fa fa fa-pencil fa-6 "></i> Edit</a>', '<a data-id="del-loc" class="btn btn-sm btn-danger del-loc" data-toggle="modal" data-target="#confirm_modal"><i data-toggle="tooltip" title="Delete" data-placement="right" class="fa fa-trash-o ml-fa"></i> Delete</a>', record['id_location'] ]).draw(false).node();
                    $(rowNode).attr( {'data-id':record['id_location'] } );
                    
                 
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Location not updated. Try again','error');
              }
            },
            error:function(){
              notify('Location not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
     }) // end of save tour click function

    // on show bs modal edit location
     $('#edit-loc').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        var ref=$(this);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var locId=invoker.parents('tr').attr('data-id');
          if(locId!=""){
              $.ajax({
                url:"<?=base_url('location/getLocationById')?>",
                type:"POST",
                data:{locId:locId},
                beforeSend:function(){},
                success:function(data){
                    var data=data.split('::');
                    if(data[2]=='success'){
                        var location=JSON.parse(data[3]);
                        ref.find('.loc_name').val(location.name);
                      //  ref.find('.loc_zone').val(location.coast); 
                        ref.find('.loc_id').val(location.id_location); 
                        //ref.find('.zone_id').val(location.zone); 

                        // select zone 
                       // $('#edit-loc').find('.loc_zone').find('option[value="'+location.zone+'"]').prop('selected', true);
                        $('#edit-loc').find('.loc_zone').val(location.zone).trigger('change');
                        $('#edit-loc').find('.loc_code').val(location.loc_code);
                    } else if(data[2]=='error'){
                        notify(data[1], data[2]);
                    }
                },
                error:function(){

                }
              })
          }

        $(this).find('#tour_op_lbl').html('Update Location'); 
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-loc').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Location'); // default title
    })

    
    function delLocation(locId){
      var row=$('#data_list').find('tr[data-id="'+locId+'"]');
      $.ajax({
        url:"<?=base_url('location/delLocation')?>",
        type:"POST",
        data:{locId:locId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            row.remove();
             var loc_count = $('.loc-count').html();
                    if($.isNumeric(loc_count) && loc_count>0){
                      loc_count=parseInt(loc_count) - 1;
                    }
                    $('.loc-count').html(loc_count);
            notify(data[1], data[2]);

          }
          else {
            notify('Location not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Location not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del loc  function

    // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-loc'){
            delLocation(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })


   
     // get roomtypes by location
      $('#roomtypes').on('show.bs.modal', function (e) {
        var invoker = $(e.relatedTarget);
        var locId=invoker.parents('tr').attr('data-id'); 
        var locname=invoker.parents('tr').children('td').eq(1).html(); 
        $(this).find('.loc-name').html(locname);
        $(this).find('.loc_id').val(locId);
        $.ajax({
          url:"<?=base_url('location/getRoomByLocId')?>",
          type:"POST",
          data:{locId:locId},
          beforeSend:function(){},
          success:function(data){ console.log(data); 
            var data=data.split('::');
            if(data[2]=='success'){
                var roomtypes=JSON.parse(data[3]);
                var htmlData='';
                $('.total-vehicle').find('.badge').html(roomtypes.length);
                $.each(roomtypes, function(i, val){
                   htmlData+='<li class="list-group-item room_loc_list bold" data-id="'+val.id_room_loc+'"><span>'+val.room_type+'</span> <a style="cursor:pointer" title="Remove Room Type" class="pull-right"><i class="fa fa-remove"></i></a></li>';
                })
                $('.room_type_list').html(htmlData);
            }
            else {
              notify('Room Type not found. Try again','error');
            }
          },
          error:function(){
            notify('Room Type not found. Try again','error');
          }
      });// end of ajax
    })


      // on close room type modal
      $('#roomtypes').on('hidden.bs.modal', function (e) { 
        $('.room_type_list').empty();
          $('.total-vehicle').find('.badge').html(0);
      })

      // room type select2
      $('.roomtype_select2').select2({
        placeholder: "Select Room Type",
        allowClear: true
      })

      // remove room type
      $(document).on('click', '.room_loc_list a', function(e){
        var item=$(this).parents('.room_loc_list');
        var loc_room_id=item.attr('data-id');
        $.ajax({
          url:"<?=base_url('location/removeRoomTypeByLoc')?>",
          type:"POST",
          data:{locRoomId:loc_room_id},
          beforeSend:function(){},
          success:function(data){ 
            var data=data.split('::');
            if(data[2]=='success'){
              // decrement room type counter by 1
              var roomtypeCount = $('.total-vehicle').find('.badge').html();
              var roomtypeCount = parseInt(roomtypeCount);
              if(roomtypeCount>0)
                $('.total-vehicle').find('.badge').html(roomtypeCount-1);
              item.remove();
              notify(data[1], data[2]);
            }
            else {
              notify('Not Removed. Try again','error');
            }
          },
          error:function(){
            notify('Not Removed. Try again','error');
          }
      });// end of ajax
      }) // end of click function

      // on assign room type to location
      $(document).on('click','.assign_room', function(e){
          var roomtype=$('.roomtype_select2').val();
          var loc=$(this).parents('#roomtypes').find('.loc_id').val();
          if(roomtype!="0") {
          $.ajax({
          url:"<?=base_url('location/assignRoomType')?>",
          type:"POST",
          data:{roomtypeId:roomtype, locId:loc },
          beforeSend:function(){},
          success:function(data){ 
            var data=data.split('::');
            if(data[2]=='success'){
              // increment room type counter by 1
              var roomtypeCount = $('.total-vehicle').find('.badge').html();
              var roomtypeCount = parseInt(roomtypeCount);
              if(roomtypeCount>=0)
                $('.total-vehicle').find('.badge').html(roomtypeCount+1);
              
              var record = JSON.parse(data[3]); console.log(record);
              if(typeof record !='undefined' && typeof record.id_room_loc!='undefined'){
                htmlData='<li class="list-group-item room_loc_list bold" data-id="'+record.id_room_loc+'"><span>'+record.room_type+'</span> <a style="cursor:pointer" title="Remove Room Type" class="pull-right"><i class="fa fa-remove"></i></a></li>'; 
                  $('.room_type_list').prepend(htmlData);
              }
              notify(data[1], data[2]);
            }
            else if(data[2]=='error') {
              notify(data[1], data[2]);
            }
          },
          error:function(){
            notify('Room Type not assigned. Try again','error');
          }
      });// end of ajax
        }
      })

      // window onload 
      window.onload = function(){
        var loc = $('#data_list').find('tbody').find('tr').children('td').eq(2);
        console.log(loc.length);
      } // end of function


       

 function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: ''
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
                      targets: 7,
                      className: 'hidden'
                    }
                  ],
                  order:[[7, 'desc' ]]
    }
    );
      table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
   
    $('#search_by_name').keyup(function(){
        table.column(1).search($(this).val()).draw() ;
    })

    $('#Search_by_zone').change(function(){
    if($(this).val()==0){
           table.column(3).search('').draw() ;
          } else {
        table.column(3).search($(this).select2('data')[0]['text']).draw() ;
      }
    })
        return table;
    }

    }); 

</script>