jQuery(function ($) {
    $('<button style="margin-left: 15px;" class="button dividelo_url_logo">Seleccionar imagen</button>').insertAfter(".dividelo_url_logo");


    $(document).on('click', '.dividelo_url_logo', function (e) {
        e.preventDefault();

        var button = $(this),
            aw_uploader = wp.media({
                title: 'imagen logo',
                library: {
                    uploadedTo: wp.media.view.settings.post.id,
                    type: 'image'
                },
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on('select', function () {
                var attachment = aw_uploader.state().get('selection').first().toJSON();
                $('.dividelo_url_logo').val(attachment.url);
            })
                .open();
    });

});