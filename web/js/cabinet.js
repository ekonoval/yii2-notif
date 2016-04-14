$(function () {

    $('body').on('click', '#cabinet-msgs .close', function () {

        $.getJSON(
            "/site/cabinet-ajax",
            {
                cmd: "msgMarkRead",
                id: $(this).data('id')
            },
            function(data){
                //console.log(data);
                $.pjax.reload({container:'#cabinet-msgs'});
            }
        );


    });
});
