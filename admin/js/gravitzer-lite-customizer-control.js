(function($){
    wp.customize.bind('ready', function() {
        var checkforformsubmit;
        if ($('#customize-control-gravitizer_hidden_for_form_id').length) {
            $('#customize-control-gravitizer_current_form select').val(-1);
        }


        
        $('body').on('click', '#accordion-panel-gravitizer_panel', function() {
            if ($('#customize-control-gravitizer_hidden_for_form_id').length) {
                //hide all the selection fields if no form selected
                $('#accordion-section-gravitizer_radio_field').hide();
                $('#accordion-section-gravitizer_text_field').hide();
                $('#accordion-section-gravitizer_switch_field').hide();
                $('#accordion-section-gravitizer_checkbox_field').hide();
                $('#accordion-section-gravitizer_dropdown_field').hide();
                $('#accordion-section-gravitizer_date_field').hide();
                $('#accordion-section-gravitizer_form_wrapper').hide();
            }
        });


        $('#_customize-input-gravitizer_current_form').on('change', function(){
            
            alert('Saved! now the page will refresh and you may continue customizing your form.');
            $('.customize-save-button-wrapper input[type=submit]').trigger('click');
            checkforformsubmit = setInterval(check_button_disabled, 1000);
        });

        function check_button_disabled() {
            if (!$('body.wp-customizer').hasClass('saving')) {
                clearInterval(checkforformsubmit);
                var reload_url_key = 'autofocus[panel]';
                var reload_url_value = 'gravitizer_panel';
                reload_url_key = encodeURIComponent(reload_url_key);
                reload_url_value = encodeURIComponent(reload_url_value);
                //get the search query from url, it starts after ?
                var kvp = document.location.search.substr(1).split('&');
                if (kvp == '') {
                    document.location.search = '?' + reload_url_key + '=' + reload_url_value;
                } else {
                    var i = kvp.length;
                    var x;
                    while (i--) {
                        x = kvp[i].split('=');
                        if (x[0] == reload_url_key) {
                            x[1] = reload_url_value;
                            kvp[i] = x.join('=');
                            break;
                        }
                    }
                    if (i < 0) {
                        kvp[kvp.length] = [reload_url_key, reload_url_value].join('=');
                    }
                    //this will reload the page, it's likely better to store this until finished
                    document.location.search = kvp.join('&');
                }
            }
        }
       
        
    });

    


})(jQuery);
    