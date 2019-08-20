jQuery(document).ready(function($) {
    wp.data.subscribe(function () {
        var isSavingPost = wp.data.select('core/editor').isSavingPost();
        var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost();

        if (isSavingPost && !isAutosavingPost) {

            console.log(isSavingPost + isAutosavingPost);
            setTimeout(function () {
                location.reload();
            }, 3000)
        }
    })
});
