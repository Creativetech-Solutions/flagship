<script>
    $(function () {
        var table=dataTableConfiguration();
 // save location
     $(document).on('click','.save-rep', function(){
        var parentMdl=$(this).parents('#edit-rep');
        var rep_name = parentMdl.find('.rep_name').val();
        var rep_phone = parentMdl.find('.rep_phone').val();
        var rep_id = parentMdl.find('.rep_id').val();
        // console.log(op_name+' dd'+opId);
        if(rep_name == ''){
          notify('Rep Name is Required','error');
        } else if(rep_phone == ''){
          notify('Rep Phone Number is Required','error');
        }
        else {
          $.ajax({
            url:"<?=base_url('rep/saveRep')?>",
            type:"POST",
            data:{rep_name:rep_name,rep_id:rep_id,rep_phone:rep_phone},
            beforeSend:function(){},
            success:function(data){
              parentMdl.modal('toggle');
              var data=data.split('::');
              if(data[2]=='success'){
                if(data[3]=='update'){
                  $('#data_list').find('tr[data-id="'+rep_id+'"]').children('td').eq(1).html(rep_name);
                  $('#data_list').find('tr[data-id="'+rep_id+'"]').children('td').eq(2).html(rep_phone);
                }
                // if new record added
                else if(data[3]=='add'){  
                  var rep_count = $('.rep-count').html();
                    if($.isNumeric(rep_count) && rep_count>-1){
                      rep_count=parseInt(rep_count) + 1;
                    }
                    $('.rep-count').html(rep_count);
                  // data table add new row 
                  var rowNode = table.row.add(['', rep_name, rep_phone, '<a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-rep"><i data-toggle="tooltip" title="Edit" class=" ml-fa fa fa-pencil fa-6 "></i> Edit</a>', '<a data-id="del-rep" class="btn btn-sm btn-danger del-rep" data-toggle="modal" data-target="#confirm_modal"><i data-toggle="tooltip" title="Delete" data-placement="right" class="fa fa-trash-o ml-fa"></i> Delete</a>', data[4] ]).draw(false).node();
                    $(rowNode).attr( {'data-id':data[4] } );
                    
                 
                }
                notify(data[1], data[2]);
              }
              // if operation fail
              else {
                notify('Rep not updated. Try again','error');
              }
            },
            error:function(){
              notify('Rep not updated. Try again','error');
            }
          }); // end of ajax
        } // end of outer if
     }) // end of save tour click function

    // on show bs modal edit location
     $('#edit-rep').on('show.bs.modal', function (e) {
      <?php //check the modal invoker element, as same modal will be use for different functionalities(add, edit) ?>
        var invoker = $(e.relatedTarget);
        var ref=$(this);
        if((invoker.attr('class')).indexOf(' edit') > -1) {
          var repId=invoker.parents('tr').attr('data-id');
          if(repId!=""){
              $.ajax({
                url:"<?=base_url('rep/getRepById')?>",
                type:"POST",
                data:{repId:repId},
                beforeSend:function(){},
                success:function(data){
                    var data=data.split('::');
                    if(data[2]=='success'){
                        var rep=JSON.parse(data[3]);
                        ref.find('.rep_name').val(rep.name);
                        ref.find('.rep_phone').val(rep.rep_phone);
                      //  ref.find('.loc_zone').val(location.coast); 
                        ref.find('.rep_id').val(rep.id_rep); 
                        //ref.find('.zone_id').val(location.zone); 
                    } else if(data[2]=='error'){
                        notify(data[1], data[2]);
                    }
                },
                error:function(){

                }
              })
          }

        $(this).find('#tour_op_lbl').html('Update Rep'); 
        }
    })

     <?php // on modal close , delete all values  ?>
     $('#edit-rep').on('hidden.bs.modal', function () {
        $(this).find('input').val("");
        $(this).find('#tour_op_lbl').html('Add New Rep'); // default title
    })

        // on confirm del click button
    $('.conf_del').on('click', function(e){
        var delMdl=$(this).parents('#confirm_modal');
        var id=delMdl.find('.id_one').val();
        var action=delMdl.find('.action_val').val();
        // check action value to perform action accordingly
        if(action=='del-rep'){
            delRep(id);
            // close modal
            $(this).parents('.modal').modal('toggle');
        }
    })

    function delRep(repId){
      var row=$('#data_list').find('tr[data-id="'+repId+'"]');
      $.ajax({
        url:"<?=base_url('rep/delRep')?>",
        type:"POST",
        data:{repId:repId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            row.remove();
             var rep_count = $('.rep-count').html();
                    if($.isNumeric(rep_count) && rep_count>0){
                      rep_count=parseInt(rep_count) - 1;
                    }
                    $('.rep-count').html(rep_count);
            notify(data[1], data[2]);

          }
          else {
            notify('Rep not deleted. Try again','error');
          }
        },
        error:function(){
          notify('Rep not deleted. Try again','error');
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
  

 function dataTableConfiguration(){
      var table=$("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: ''
                    },
                    {
                      targets: 3,
                      className: 'text-center'
                    },
                    {
                      targets: 4,
                      className: 'text-center'
                    },
                    {
                      targets: 5,
                      className: 'hidden'
                    }
                  ],
                  order:[[5, 'desc' ]]
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
    $('#search_by_phone').keyup(function(){
            table.column(2).search($(this).val()).draw() ;
        })
        return table;
    }

    }); 

</script>