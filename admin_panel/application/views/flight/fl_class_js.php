<?php ?>
<script>
  $(function () {
    var table=dataTableConfiguration();

    function delFlightClass(flClassId){
      var row=$('#data_list').find('tr[data-id="'+flClassId+'"]');
      $.ajax({
        url:"<?=base_url('flight/delFlightClass')?>",
        type:"POST",
        data:{fl_class_id:flClassId},
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
            notify('Flight Class not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Flight Class not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del flight function

      // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-fl-class'){
            delFlightClass(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

      // on open tour edit modal 
     $('#edit-fl-class').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var fl_class_id=invoker.parents('.flight').attr('data-id');
          var fl_class=invoker.parents('.flight').find('.fl_class').html();
          var fl_class = fl_class.replace(/&amp;/g, '&');
          $(this).find('.fl_class').val(fl_class);
          $(this).find('.fl_class_id').val(fl_class_id);
          $(this).find('#tour_op_lbl').html('Edit Flight Class'); // set the modal title according to functionality
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-fl-class').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Flight Class'); // default title
    })
     // on save 
     $(document).on('click','.save-fl-class', function(){
        var parentMdl=$(this).parents('#edit-fl-class');
        var fl_class = parentMdl.find('.fl_class').val();
        var fl_class_id = parentMdl.find('.fl_class_id').val();
        console.log(fl_class+' dd'+fl_class_id);
        if(fl_class!=''){
          $.ajax({
            url:"<?=base_url('flight/saveFlightClass')?>",
            type:"POST",
            data:{fl_class_id:fl_class_id,fl_class:fl_class},
            beforeSend:function(){},
            success:function(data){
              var data=data.split('::');
              if(data[2]=='success'){
                // close modal
                parentMdl.modal('toggle');
                // if record updated
                if(data[3]=='update'){
                  $('.flight[data-id="'+fl_class_id+'"]').find('.fl_class').html(fl_class);
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
                  var rowNode = table.row.add(['', record['class'] ,'<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-fl-class"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-fl-class" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-flight"><i class="fa fa-trash"></i> Delete</a>',record['id']] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id'], 'class':'flight' } );
                    
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Flight Class not updated. Try again','error');
              }
            },
            error:function(){
              notify('Flight Class not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else { // if input is empty
          notify('Flight Class is Required','error');
        }
     }) // end of save tour click function

  <?php // on flight timing modal opens, get time and display in modal ?>
  
    function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: 'fl_class'
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

   /* // fetch time value on change timepicker input
   $('.timepicker').timepicker().on('changeTime.timepicker', function(e) {
    console.log('From:'+ $('.timepicker.from').val());
    console.log('To ' + $('.timepicker.to').val());
  });*/
  });

</script>