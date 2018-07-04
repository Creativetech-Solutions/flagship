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
                      className: 'op_name'
                    },
                    {
                      targets: 3,
                      className: 'amount'
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


    function delTourOp(opId){
      var row=$('#data_list').find('tr[data-id="'+opId+'"]');
      $.ajax({
        url:"<?=base_url('fasttrack/delOperator')?>",
        type:"POST",
        data:{opId:opId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            var tour_count = $('.tour-count').html();
            if($.isNumeric(tour_count) && tour_count>0){
              tour_count=parseInt(tour_count) - 1;
            }
             $('.tour-count').html(tour_count);
            notify(data[1], data[2]);
          }
          else {
            notify('Tour Operator not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Tour Operator not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del  function

      // on open tour edit modal 
     $('#edit-tour').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var op_id=invoker.parents('.tour_operator').attr('data-id');
          var op_name=invoker.parents('.tour_operator').find('.op_name').html();
          var amount=invoker.parents('.tour_operator').find('.amount').html();
          var op_name = op_name.replace(/&amp;/g, '&');
          $(this).find('.op_name').val(op_name);
          $(this).find('.op_id').val(op_id);
          $(this).find('.amount').val(amount);
          $(this).find('#tour_op_lbl').html('Edit Tour Operator'); // set the modal title according to functionality
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-tour').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add Tour Operator'); // default title
    })
     // on save edit tour operator
     $(document).on('click','.save-tour', function(){
        var parentMdl=$(this).parents('#edit-tour');
        var op_name = parentMdl.find('.op_name').val();
        var opId = parentMdl.find('.op_id').val();
        var amount = parentMdl.find('.amount').val();
        // console.log(op_name+' dd'+opId);
        if(op_name!='' && amount!=''){
          $.ajax({
            url:"<?=base_url('fasttrack/saveOperator')?>",
            type:"POST",
            data:{opId:opId,op_name:op_name, amount:amount},
            beforeSend:function(){},
            success:function(data){
              parentMdl.modal('toggle');
              var data=data.split('::');
              if(data[2]=='success'){
                // if record updated
                if(data[3]=='update'){
                  $('.tour_operator[data-id="'+opId+'"]').find('.op_name').html(op_name);
                  $('.tour_operator[data-id="'+opId+'"]').find('.amount').html(amount);
                }
                // if new record added
                else if(data[3]=='add'){
                  var record= JSON.parse(data[4]);
                  // update counter
                  var tour_count = $('.tour-count').html();
                    if($.isNumeric(tour_count) && tour_count>-1){
                      tour_count=parseInt(tour_count) + 1;
                    }
                    $('.tour-count').html(tour_count);
                  // data table add new row 
                  var rowNode = table.row.add( [ '', record['id'], record['tour_operator'] ,record['amount'] ,'<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-tour"><i class="fa fa-pencil"></i> Edit</a>', '<a data-id="del-tourop" class="btn btn-sm btn-danger del-tourop" data-toggle="modal" data-target="#confirm_modal"><i class="fa fa-trash"></i> Delete</a>' ] ).draw().node();
                    $(rowNode).attr( {'data-id':record['id'], 'class':'tour_operator' } );
                    
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Tour Operator not updated. Try again','error');
              }
            },
            error:function(){
              notify('Tour Operator not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
        else if(op_name=='') { // if input is empty
            notify('Operator Name is Required','error');
        } else if(amount==''){
            notify('Amount is Required','error');
        }
     }) // end of save tour click function

      // on click delete confirm
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-tourop'){
            delTourOp(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

  });

</script>