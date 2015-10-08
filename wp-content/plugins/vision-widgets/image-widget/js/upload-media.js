jQuery(document).ready(function($) {
    $(document).on("click", ".upload_image_button", function() {

        //Make the text field for the image url available to the function below
        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imgurl = jQuery('img', html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');

            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }
            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    $('body').on('focus', '.color-picker', function(){
        var parent = $(this).parent();
        $(this).wpColorPicker()
        parent.find('.wp-color-result').click();
    });


});