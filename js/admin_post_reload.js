jQuery(document).ready(function($) {
    wp.data.subscribe(function () {
        postsaving = wp.data.select('core/editor').isSavingPost();
        autosaving = wp.data.select('core/editor').isAutosavingPost();
        success = wp.data.select('core/editor').didPostSaveRequestSucceed();
        if (postsaving || autosaving) {

            window.location.href = window.location.href + '&refreshed=1';
        }
    })
});