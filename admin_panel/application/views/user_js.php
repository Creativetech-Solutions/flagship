<?php ?>
<script>
  // check if session value set this display
  <?php if($this->session->flashdata('form_success')){ ?>
    notify("<?=$this->session->flashdata('form_success')?>", "success");
  <?php } ?>
  $(function () {

    // select2 place holder search by status
    $('.userstatus').select2({
       placeholder: "Search By Status",
        allowClear: true
    }); 
    // select2 place holder search by level
    $('.userlevel').select2({
       placeholder: "Search By level",
        allowClear: true
    });
    var table=dataTableConfiguration();

  // date range picker
  $('.date-time').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "timePicker": true,
    "timePickerSeconds": true,
    locale: {
            format: 'MM/DD/YYYY hh:mm:ss'
        }
  }, function(start, end, label) {
    console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
  });

  // save user record 

  $(document).on('submit','.user-edit-form', function(e){
    e.preventDefault();
    var form=$(this);
    $.ajax({
      type: "POST",
      url: form.attr( 'action' ),
      // data: form.serialize(),
      data:  new FormData(this),
      contentType: false,
      cache: false, 
      processData:false,
      beforeSend:function(){

      },
      success: function( data ) {
          var data=data.split('::');
          if(data[2]=='success'){
            notify(data[1], data[2]);
          } else if(data[2]=='error'){
            $('.errors').append(data[1]);
          }
      },
      error:function(){

      }
    });
  })

  // on click chose file button
  $('.choose-avatar').on('click', function(e){
    $('.avatar').trigger('click');
  })

  // close error dialog
  $(document).on('click', '.close-error', function(e){
    $(this).parents('.errors').hide();
  })

  $(".avatar").change(function(){
   
      readURL(this);
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.prof_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

  // on click delete confirm
$('.conf_del').on('click', function(e){
    var delMdl=$(this).parents('#confirm_modal');
    var id=delMdl.find('.id_one').val();
    var action=delMdl.find('.action_val').val();
    // check action value to perform action accordingly
    if(action=='del-user'){
        delUser(id);
        // close modal
        $(this).parents('.modal').modal('toggle');
    }
})

    // delet user

     function delUser(userId){
      var row=$('#data_list').find('tr[data-id="'+userId+'"]');
      $.ajax({
        url:"<?=base_url('user/delUser')?>",
        type:"POST",
        data:{userId:userId},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          if(data[2]=='success'){
            table.row(row).remove().draw();
            notify(data[1], data[2]);
          }
          else {
            notify('User not deleted. Try again','error');
          }
        },
        error:function(){
          notify('User not deleted. Try again','error');
        }
      });// end of ajax
    } // end of del user function

    // select users by status or level
    $('.userstatus, .userlevel').on('select2:select', function(e){
        var keyVal=$(this).val();
        var invoker=$(this).attr('data-id'); 
        if(keyVal!='' && invoker!=''){
           $.ajax({
              url:"<?=base_url('user/getUserByInvoker')?>",
              type:"POST",
              data:{key:keyVal, invoker:invoker},
              beforeSend:function(){},
              success:function(data){
                $('.user-list').html(data);
                var table=dataTableConfiguration();
              },
              error:function(){
                notify('Error Occur. Try again','error');
              }
          });// end of ajax
        }
    })


    // on unselect status 
    $('.userstatus, .userlevel').on('select2:unselect', function(e){
           $.ajax({
              url:"<?=base_url('user/getAllUsers')?>",
              beforeSend:function(){},
              success:function(data){
                $('.user-list').html(data);
                var table=dataTableConfiguration();
              },
              error:function(){
                notify('Error Occur. Try again','error');
              }
          });// end of ajax
    })

    // data table configuration
    function dataTableConfiguration(){
      var table = $("#data_list").DataTable({
      columnDefs: [
                    {
                      targets: 1,
                      className: 'username'
                    },
                    {
                      targets: 2,
                      className: 'fullname'
                    },
                    {
                      targets: 3,
                      className: 'usr_status'
                    },
                    {
                      targets: 4,
                      className: 'level'
                    }
                  ]
          }
      );
      table.on( 'order.dt search.dt', function () {
              table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();

      
      $('#search_by_name').keyup(function(){
          table.column(2).search($(this).val()).draw() ;
      })
      $('#search_by_username').keyup(function(){
          table.column(1).search($(this).val()).draw() ;
      })
      $('#search_by_status').keyup(function(){
          table.column(3).search($(this).val()).draw() ;
      })
      $('#search_by_level').keyup(function(){
          table.column(4).search($(this).val()).draw() ;
      })
      return table;
          }
      })
</script>
