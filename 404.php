<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Html-template-into-wordpress
 */

get_header();
?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">404
        <small>Page Not Found</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo home_url(); ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">404</li>
    </ol>

    <div class="jumbotron">
        <h1 class="display-1">404</h1>
        <p>The page you're looking for could not be found.</p>
        <div class="home-btn">
            <a class="btn btn-lg btn-secondary btn-block" href="<?php echo home_url(); ?>">Return Home</a>
        </div>
    </div>

</div>
<!-- /.container -->

<?php
get_footer();