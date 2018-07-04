
<div class="modal fade" id="add_mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header col-md-12">
        <h5 class="modal-title pull-left" id="mdl_title">Specify Other Transport Mode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12"">
        <form>
          <div class="form-group">
            <label for="other_mode" class="form-control-label other_name">Other Mode:</label>
            <input type="text" class="form-control" id="field_val">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-id="" class="btn btn-primary save_val">Save</button>
      </div>
    </div>
  </div>
</div>

  <script>

  // on show modal set data-id to perform operation accordingly
    $(document).on('show.bs.modal','#add_mdl', function(e){
        var invoker = $(e.relatedTarget);
        var field = invoker.attr('data-id'); console.log(field); 
        if(field=='supplier'){
           $(this).find('#mdl_title').html('Specify Other Supplier');
           $(this).find('.other_name').html('Other Supplier');
        } else {
           $(this).find('#mdl_title').html('Specify Other Transport Mode');
           $(this).find('.other_name').html('Other Mode');
        }
        $(this).find('.save_val').attr('data-id',field);
    })
    // add new supplier
    $(document).on('click','.save_val', function(e){ 
        if($(this).attr('data-id')=='transport_mode'){
            var transport_mode=$(this).parents('.modal').find('#field_val').val();
            console.log(transport_mode);
            if(transport_mode!=''){
                $.ajax({
                    url: "<?=$url?>/custom_updates/save_field_val.php",
                    type:"POST",
                    data:{transport_mode:transport_mode},
                    beforeSend:function(){},
                    success:function(data){
                        var data=data.split('::');
                        if(data[0]=='OK'){
                            var records=JSON.parse(data[2]);
                            console.log(records);
                            var options='';
                            $.each(records, function(i, val){
                                options+='<option value="'+records['transport_type']+'">'+records['transport_type']+'</option>'
                            })
                           // $('#arr-transport').html(options);
                           location.reload();
                        } else {
                            alert(data[1]);
                        }

                        $('#add_mdl').modal('toggle');
                    },
                    error:function(){

                        $('#add_mdl').modal('toggle');
                    }
                }); // end of ajax
            } // end of if
        } // end of if

        // for adding supplier
        else if($(this).attr('data-id')=='supplier'){
            var supplier=$(this).parents('.modal').find('#field_val').val();
            console.log(supplier);
            if(supplier!=''){
                $.ajax({
                    url: "<?=$url?>/custom_updates/save_field_val.php",
                    type:"POST",
                    data:{supplier:supplier},
                    beforeSend:function(){},
                    success:function(data){
                        var data=data.split('::');
                        if(data[0]=='OK'){
                           // var records=JSON.parse(data[2]);
                           // console.log(records);
                           /* var options='';
                            $.each(records, function(i, val){
                                options+='<option value="'+records['transport_type']+'">'+records['transport_type']+'</option>'
                            })*/
                           // $('#arr-transport').html(options);
                           location.reload();
                        } else if (data[0]=='FAIL'){
                            alert(data[1]);
                        }
                        $('#add_mdl').modal('toggle');
                    },
                    error:function(){
                        $('#add_mdl').modal('toggle');}
                }); // end of ajax
            } // end of if
        } // end of if
    })
    </script>