<?php
/*
Template Name: Contact
*/

?>

<?php get_header() ?>


    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

        <input name="search-country" type="text" id="search-box" list="search-results" placeholder="Country Name"/>
        <datalist id="search-results"></datalist>
        <br>
        <input id="searchCityField" type="text" size="50" placeholder="Enter a city" autocomplete="off">
        <br>
        <input id="searchRegionField" type="text" size="50" placeholder="Enter a region" autocomplete="off">
        <br>
        <input type="hidden" name="action" value="add_autocomplete">
        <input type="submit" value="Submit">
    </form>

<?php get_sidebar() ?>
<?php get_footer() ?>