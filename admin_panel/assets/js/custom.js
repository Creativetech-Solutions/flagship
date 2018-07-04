function notify(message,messageType) {
    var n = noty({
        text: message,
        type:messageType,
        animation: {
            open: {height: 'toggle'}, // jQuery animate function property object
            close: {height: 'toggle'}, // jQuery animate function property object
            easing: 'swing', // easing,
            speed: 500 // opening & closing animation speed
        },
        timeout:5000,
        closeWith:['click'],
        buttons:false
    });
}
// on confirm modal opens
$('#confirm_modal').on('show.bs.modal', function(e){
    var invoker = $(e.relatedTarget);
    var invokrdt=invoker.attr('data-id');
    $(this).find('.id_one').val(invoker.parents('tr').attr('data-id'));
    $(this).find('.action_val').val(invokrdt);
})


