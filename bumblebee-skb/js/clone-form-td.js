/*
Author: Alvin Herbert
Last updated: March 30, 2015
*/

$(function () {
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    
    /*  This is where we manipulate the name/id values of the input inside the new, cloned element
        Below are examples of what forms elements you can clone, but not the only ones.
        There are 2 basic structures below: one for an H2, and one for form elements.
        To make more, you can copy the one for form elements and simply update the classes for its label and input.
        Keep in mind that the .val() method is what clears the element when it gets cloned. Radio and checkboxes need .val([]) instead of .val('').
    */
        // H2 - section
        //newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_reference').attr('name', 'ID' + newNum + '_reference').html('Entry #' + newNum);
        
        // First name - text
        newElem.find('.select_ttl').attr('id', 'guest-title-name' + newNum).attr('name', 'guest_title_name' + newNum).val('');
        
        // First name - text
        newElem.find('.input_fn').attr('id', 'guest-first-name' + newNum).attr('name', 'first_name' + newNum).val('');

        // Last name - text
        newElem.find('.input_ln').attr('id','guest-last-name').attr('name', 'last_name' + newNum).val('');

        // Adult - checkbox
        newElem.find('.label_checkboxitem').attr('for', 'checkboxitem' + newNum);
        newElem.find('.input_checkboxitem').attr('id', 'checkboxitem' + newNum).attr('name', 'checkboxitem' + newNum).val([]);

        // PNR - text
        newElem.find('.input_pnr').attr('id', 'guest-pnr' + newNum).attr('name', 'guest_pnr' + newNum).val('');

        // Child - text
        newElem.find('.input_guest_child').attr('id', 'child_age').attr('name', 'child_age' + newNum).val('');
        
        // Infant - text
        newElem.find('.input_guest_infant').attr('id', 'infant_age').attr('name', 'infant_age' + newNum).val('');

    // Insert the new element after the last "duplicatable" input field
        $('#entry' + num).after(newElem);
        $('#guest-title-name' + newNum).focus();

    // Enable the "remove" button. This only shows once you have a duplicated section.
        $('#btnDel').attr('disabled', false);

    // Right now you can only add 49 sections, for a total of 50 guest.
        if (newNum == 50)
        $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit"); // value here updates the text in the 'add' button when the limit is reached 
    });

    $('#btnDel').click(function () {
    // Confirmation dialog box. Works on all desktop browsers and iPhone.
        if (confirm("Are you sure you wish to remove this guest? This cannot be undone."))
            {
                var num = $('.clonedInput').length;
                // how many "duplicatable" input fields we currently have
                $('#entry' + num).slideUp('slow', function () {$(this).remove();
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnDel').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd').attr('disabled', false).prop('value', "+");});
            }
        return false; // Removes the last section you added
    });
    // Enable the "add" button
    $('#btnAdd').attr('disabled', false);
    // Disable the "remove" button
    $('#btnDel').attr('disabled', true);
});