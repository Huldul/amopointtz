$(document).ready(function() {
    function toggleFields() {
        var selectedType = $('select[name="type_val"]').val();
        
        $('input').closest('p').hide();
        $('input[name*="' + selectedType + '"]').closest('p').show();
    }
    toggleFields();
    $('select[name="type_val"]').change(function() {
        toggleFields();
    });
});
//Это в виде скрипта