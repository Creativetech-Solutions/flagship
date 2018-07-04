$(document).ready(function() {

    $('.button-add').click(function(){
        //we select the box clone it and insert it after the box
        //we select the box clone it and insert it after the box
        $('.box:first').clone().insertAfter(".box:last");
    });
    
    $(document).on("click", ".button-remove", function() {
        $(this).closest(".box").remove();
    });
});