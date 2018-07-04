  <?php ?>
  <script>

  // on show modal set data-id to perform operation accordingly
    $('#add_mdl').on('show.bs.modal', function(e){
        var invoker = $(e.relatedTarget);
        var field = invoker.attr('data-id'); console.log(field);
        $(this).find('#mdl_title').val('Specify Other Transport Mode');
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
    })
    </script>