<?php global $rcl_options,$user_LK; ?>

<?php rcl_before(); ?>

<div id="rcl-<?php echo $user_LK; ?>" class="wprecallblock clearfix">
    <?php rcl_notice(); ?>

    <div id="profile_header">
        <div class="lk-header rcl-node">
            <?php rcl_header(); ?>
        </div>
        <div class="item img_wrap">
            <div class="lk-avatar">
                <?php rcl_avatar(120); ?>
            </div>
            <div class="rcl-node">
                <?php rcl_sidebar(); ?>
            </div>
        </div>
        <div class="item head_info">
            <h1><?php rcl_username(); ?></h1>
            <ul>
                <li class="profile-info">
                    <span>joined </span><?php echo date("d M Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?>
                </li>
                <li class="profile-info">
                    <span>last login </span><?php echo date("d M ", strtotime(get_userdata(get_current_user_id( ))->user_login)); ?>
                </li>
                <li class="profile-info">
                    <?php echo '<span>posts </span> ' . count_user_posts(1); ?>
                </li>
                <li class="profile-info">
                   <?php
                   $csql = "SELECT c.comment_author, c.comment_parent,
u.ID, u.display_name
FROM ".$wpdb->users." AS u
LEFT JOIN ".$wpdb->comments." AS c ON (c.comment_author = u.display_name)
WHERE ( c.comment_author = u.display_name )
GROUP BY u.ID";
                   ?>
                </li>
            </ul>
            <div class="rcl-user-status">
                <?php rcl_status_desc(); ?>
            </div>
            <div class="rcl-content">
                <?php rcl_content(); ?>
            </div>
            <div class="lk-footer rcl-node">
                <?php rcl_footer(); ?>
            </div>
        </div>

    </div>

    <?php $class = (isset($rcl_options['buttons_place'])&&$rcl_options['buttons_place']==1)? "left-buttons":""; ?>
    <div class="col-md-offset-2 col-md-10" id="rcl-tabs">
        <div id="lk-menu" class="rcl-menu <?php echo $class; ?> rcl-node">
            <?php rcl_buttons(); ?>
        </div>
        <div id="lk-content" class="rcl-content">
            <?php rcl_tabs(); ?>
        </div>
    </div>
</div>
<script>
        var elems = document.getElementByClassNameId("wprecallblock").style.width = "100%";
</script>

<?php rcl_after(); ?>

