$(document).ready(function($) {
        if ($(".editor-post-featured-image__preview").length < 1){
            wp.data.dispatch('core/notices').createNotice(
                'error', // Can be one of: success, info, warning, error.
                'This post has no featured image. Please set one.', // Text string to display.
                {
                    isDismissible: false, // Whether the user can dismiss the notice.
                    // Any actions the user can perform.
                    actions: [
                        {
                            url: '#',
                        }
                    ]
                }
            );
        }
});

