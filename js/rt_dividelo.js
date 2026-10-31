jQuery(function ($) {
    $(document).on('click', '.rt-dividelo-pick-logo', function (event) {
        event.preventDefault();
        if (!window.wp || !wp.media) return;
        const picker = wp.media({ title: 'Seleccionar imagen', library: { type: 'image' }, button: { text: 'Utilizar imagen' }, multiple: false });
        picker.on('select', function () {
            const file = picker.state().get('selection').first();
            if (file) $('#dividelo_url_logo').val(file.get('url')).trigger('change');
        });
        picker.open();
    });
});
