/**
 * Handle the custom post type nav menu meta box
 */
jQuery( document ).ready( function($) {
    $( '#submit-post-type-archives' ).click( function( event ) {
        event.preventDefault();
        

        var $hptal_list_items = $( '#' + multisite_nav_obj.metabox_list_id + ' li :checked' );
        var $hptal_submit = $( 'input#submit-post-type-archives' );

        // Get checked boxes
        var postTypes = [];
        var blogId = [];
        $hptal_list_items.each( function() {
            blogId.push($(this).siblings().val());
            postTypes.push( $( this ).val() );
        } );


        // Get blog ids

        // Show spinner
        $( '#' + multisite_nav_obj.metabox_id ).find('.spinner').show();

        // Disable button
        $hptal_submit.prop( 'disabled', true );

        // Send checked post types with our action, and nonce
        $.post( multisite_nav_obj.ajaxurl, {
                blogId: blogId[0],
                action: multisite_nav_obj.action,
                posttypearchive_nonce: multisite_nav_obj.nonce,
                ids: postTypes,
                nonce: multisite_nav_obj.nonce
            },

            // AJAX returns html to add to the menu, hide spinner, remove checks
            function( response ) {
                $( '#menu-to-edit' ).append( response );
                $( '#' + multisite_nav_obj.metabox_id ).find('.spinner').hide();
                $hptal_list_items.prop("checked", false);
                $hptal_submit.prop( 'disabled', false );
            }
        );
    } );
} );
