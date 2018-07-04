<?php ?>
<script>
  $(function () {
    var table=dataTableConfiguration();

    function delFlight(flightId){
      var row=$('#data_list').find('tr[data-id="'+flightId+'"]');
      $.ajax({
        url:"<?=base_url('flight/delFlight')?>",
        type:"POST",
        data:{flightId:flightId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            var flight_count = $('.flight-count').html();
            if($.isNumeric(flight_count) && flight_count>0){
              flight_count=parseInt(flight_count) - 1;
            }
             $('.flight-count').html(flight_count);
            notify(data[1], data[2]);
          }
          else {
            notify('Flight not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Flight not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del flight function

      // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-flight'){
            delFlight(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

      // on open tour edit modal 
     $('#edit-flight').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var flight_id=invoker.parents('.flight').attr('data-id');
          var flight_num=invoker.parents('.flight').find('.fl_num').html();
          var flight_num = flight_num.replace(/&amp;/g, '&');
          $(this).find('.flight_num').val(flight_num);
          $(this).find('.flight_id').val(flight_id);
          $(this).find('#tour_op_lbl').html('Edit Flight Number'); // set the modal title according to functionality
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-flight').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Flight'); // default title
    })
     // on save 
     $(document).on('click','.save-flight', function(){
        var parentMdl=$(this).parents('#edit-flight');
        var flight_num = parentMdl.find('.flight_num').val();
        var flightId = parentMdl.find('.flight_id').val();
        console.log(flight_num+' dd'+flightId);
        if(flight_num!=''){
          $.ajax({
            url:"<?=base_url('flight/saveflight')?>",
            type:"POST",
            data:{flightId:flightId,flight_num:flight_num},
            beforeSend:function(){},
            success:function(data){
              var data=data.split('::');
              if(data[2]=='success'){
                // close modal
                parentMdl.modal('toggle');
                // if record updated
                if(data[3]=='update'){
                  $('.flight[data-id="'+flightId+'"]').find('.flight_num').html('<span class="fl_num">'+flight_num+'</span>'+
                  '<a class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#fl_times"> <i class="fa fa-clock-o" aria-hidden="true"></i> Timings</a>');
                }
                // if new record added
                else if(data[3]=='add'){
                  var record= JSON.parse(data[4]);
                  // update counter
                  var flight_count = $('.flight-count').html();
                    if($.isNumeric(flight_count) && flight_count>-1){
                      flight_count=parseInt(flight_count) + 1;
                    }
                    $('.flight-count').html(flight_count);
                  // data table add new row 
                  var rowNode = table.row.add(['', '<span class="fl_num">'+record['flight_number']+'</span><a class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#fl_times"> <i class="fa fa-clock-o" aria-hidden="true"></i> Timings</a>' ,'<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-flight"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-flight" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-flight"><i class="fa fa-trash"></i> Delete</a>',record['id_flight']] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id_flight'], 'class':'flight' } );
                    
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Flight not updated. Try again','error');
              }
            },
            error:function(){
              notify('Flight not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else { // if input is empty
          notify('Flight Number is Required','error');
        }
     }) // end of save tour click function

  <?php // on flight timing modal opens, get time and display in modal ?>
  $('#fl_times').on('show.bs.modal',function(e){
    var invoker = $(e.relatedTarget);
    var fl_num = invoker.parents('.flight').find('.fl_num').html();
    $(this).find('.fl_num').html(fl_num);
  })

  // after shown flight times modal
  $('#fl_times').on('shown.bs.modal',function(e){
    var invoker = $(e.relatedTarget);
    var flightId = invoker.parents('.flight').attr('data-id');
    $(this).find('.flight_id').val(flightId);
    $.ajax({
      url:"<?=base_url('flight/getFlightTimesById')?>",
      type:"POST",
      data:{flightId:flightId},
      beforeSend:function(){},
      success:function(data){
        $('.fltime_wrap').html(data);
      },
      error:function(){}
    });
  })

    <?php // on modal close , delete all values  ?>
     $('#fl_times').on('hidden.bs.modal', function () {
        $(this).find('fltime_wrap').empty();
    })

     // edit flight time

     $(document).on('click','.edit-fl-time', function(e){
        $(this).parents('.flight').find('input').removeClass('disable').addClass('form-control');
        $(this).parents('.flight').find('input').prop('readonly', false);
        $(this).removeClass('btn-primary edit-fl-time').addClass('btn-success save-fl-time');
        $(this).attr('title','Save');
        $(this).html('<i class="fa fa-floppy-o"></i>')
     })

     // save time
     $(document).on('click','.save-fl-time', function(e){
        var ref=$(this);
        var input=$(this).parents('.flight').find('input');
        var fltime_id=$(this).parents('.flight').attr('data-id');
        var flightId=$(this).parents('.flight').attr('data-fl-id');
        var fltime=input.val();
        if(fltime_id!='' && flightId!=''){
          $.ajax({
            url:"<?=base_url('flight/updateFlightTime')?>",
              type:"POST",
              data:{flightId:flightId, fltime_id:fltime_id, fltime:fltime},
              beforeSend:function(){},
              success:function(data){
                var data=data.split('::');
                if(data[2]=='success'){
                  input.removeClass('form-control').addClass('disable');
                  input.prop('readonly', true);
                  ref.addClass('btn-primary edit-fl-time').removeClass('btn-success save-fl-time');
                  ref.attr('title','Edit');
                  ref.html('<i class="fa fa-pencil"></i>');
                  notify(data[1], data[2]);
                }
                else {
                  notify(data[1], data[2]);
                }
              },
              error:function(){
                notify('Record not updated. Try again','error');
              }
            });
        }

     })

     // delete time 
     $(document).on('click','.del-fl-time', function(e){
        var ref=$(this);
        var fltime_id=$(this).parents('.flight').attr('data-id');
        var flightId=$(this).parents('.flight').attr('data-fl-id');
        if(fltime_id!='' && flightId!=''){
          $.ajax({
            url:"<?=base_url('flight/delFlightTime')?>",
              type:"POST",
              data:{flightId:flightId, fltime_id:fltime_id},
              beforeSend:function(){},
              success:function(data){
                var data=data.split('::');
                if(data[2]=='success'){
                  notify(data[1], data[2]);
                  ref.parents('.flight').remove();
                }
                else {
                  notify(data[1], data[2]);
                }
              },
              error:function(){
                notify('Record not deleted. Try again','error');
              }
            });
        }
     })

     // add new flight time 
     $(document).on('click','.add-time', function(e){
        var ref=$(this);
        var flightId=$(this).parents('.modal-body').find('.flight_id').val();
        var fl_time=$(this).parents('.modal-body').find('.fl_time').val();
        console.log(flightId); console.log(fl_time); 
        if(flightId!='' && fl_time!=''){
          $.ajax({
            url:"<?=base_url('flight/addFlightTime')?>",
              type:"POST",
              data:{fl_time:fl_time, flightId:flightId},
              beforeSend:function(){},
              success:function(data){
                var data=data.split('::');
                if(data[2]=='success'){
                  var record=JSON.parse(data[3]);
                  var totalrecord=$('#time_list').find('tbody').find('tr').length+1;
                  var newRecord='<tr class="flight" data-id="'+record.id_fltime+'" data-fl-id="'+record.id_flight+'">'+
                  '<td>'+totalrecord+'</td>'+
                  '<td><input class="disable" type="text" value="'+record.flight_time+'" readonly ></td>'+
                  '<td class="text-center"><a title="Edit" class="btn btn-sm btn-primary btn-xs edit-fl-time">'+
                  '<i class="fa fa-pencil"></i> </a></td>'+
                  '<td class="text-center"><a class="btn btn-sm btn-danger btn-xs del-fl-time"><i class="fa fa-trash"></i>'+
                  '</a></td></tr>';
                  $('#time_list').find('tbody').append(newRecord);
                }
                else {
                  notify(data[1], data[2]);
                }
              },
              error:function(){
                notify('Time not added. Try again','error');
              }
            });
        }
        else {
          notify('Flight Time is Required','error');
        }

     })

    $('.time-search').select2({
      placeholder: "Search by Flight Time",
      allowClear:true
    });
  

    // get times list
    function getTimes(){
      $.ajax({
          url:"<?=base_url('flight/getTimes')?>",
          beforeSend:function(){},
          success:function(data){
            var data=data.split('::');
            if(data[2]=='success'){
              var times=JSON.parse(data[3]);
              var htmldata='';
              $('.time-search').find('option').remove();
              $.each(times, function(i, val){
                htmldata+='<option value="'+val.id_fltime+'">'+val.flight_time+'</option>';
              })
              $('.time-search').append(htmldata);
            }
          },
          error:function(){}
        });
    }
    // on flight time dropdown select 
    $('.time-search').on('select2:select', function (evt) {
        var timeId=$(this).val();
        if(timeId!=''){
          $.ajax({
            url:"<?=base_url('flight/getFlightByTime')?>",
            data:{timeId:timeId},
            type:'POST',
            beforeSend:function(){},
            success:function(data){
              $('.flights-list').html(data);
              var table=dataTableConfiguration();

            },
            error:function(){}
          });
        }
    });
    // on clear flight time search dropdown 
    $('.time-search').on('select2:unselect', function (evt) {
        $.ajax({
            url:"<?=base_url('flight/getFlights')?>",
            beforeSend:function(){},
            success:function(data){
              $('.flights-list').html(data);
              var table=dataTableConfiguration();

            },
            error:function(){}
          });
    });

    function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: 'flight_num'
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

    $('#search_by_fl_num').keyup(function(){
        table.column(1).search($(this).val()).draw() ;
    })
        return table;
    }

    
    // on load, get time list
    window.onload=function(){
      getTimes();
    }


    // flight time picker
    $('.fl_time').timepicker({
      showInputs: false,
      showMeridian:false,
      defaultTime:'00:00'
    });
    // time picker for search
    $(".timepicker.from").timepicker({
      showInputs: false,
      showMeridian:false,
      defaultTime:'12:00'
    });

    // time to
    $(".timepicker.to").timepicker({
      showInputs: false,
      showMeridian:false,
      defaultTime:'12:00'
    });

    // on timepicker widget opens
    var from, to;
    $('.timepicker').timepicker().on('show.timepicker', function(e) {
        from=$('.timepicker.from').val();
        to=$('.timepicker.to').val();
    })

    // on timepicker widget hide
    $('.timepicker.from, .timepicker.to').timepicker().on('hide.timepicker', function(e) {
        newfrom=$('.timepicker.from').val();
        newto=$('.timepicker.to').val();
        if(newfrom!=from || newto!=to){
           $.ajax({
            url:"<?=base_url('flight/getFlightByTimeRange')?>",
            type:"POST",
            data:{ from:newfrom, to:newto },
            beforeSend:function(){},
            success:function(data){
              $('.flights-list').html(data);
              var table=dataTableConfiguration();

            },
            error:function(){}
          });
        }

    })

   /* // fetch time value on change timepicker input
   $('.timepicker').timepicker().on('changeTime.timepicker', function(e) {
    console.log('From:'+ $('.timepicker.from').val());
    console.log('To ' + $('.timepicker.to').val());
  });*/
  });

</script>