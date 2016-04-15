$(function(){
    $('#eventCodeId').change(function(){
        var eventCode = $(this).val();
        var placeholdersBox = $('#placeHolders');

        if (!eventCode) {
            placeholdersBox.hide();
            return false;
        }

        $.get(
            "/backend/notification-crud/tags-related",
            {
                eventCode: eventCode
            },
            function(data){
                placeholdersBox.show();
                placeholdersBox.html(data);
            }
        );
    }).change();
});
