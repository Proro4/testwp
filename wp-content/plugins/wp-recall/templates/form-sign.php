<?php global $typeform;
    if(!$typeform||$typeform=='sign') $f_sign = 'style="display:block;"'; ?>
<div class="form-tab-rcl" id="login-form-rcl" <?php echo $f_sign; ?>>
    <h4 class="form-title"><?php _e('SIGN IN','wp-recall'); ?></h4>

    <?php rcl_notice_form('login'); ?>
    <div class='social_sign'>
        <p>
            with your social network
        </p>

        <b>or</b>
    </div>

    <form class="form-pop-up-reg" action="<?php rcl_form_action('login'); ?>" method="post">
        <div class="form-block-rcl">
            <div class="default-field">
                <input required placeholder="E-mail" type="text" value="<?php echo $_REQUEST['user_login']; ?>" name="user_login">
            </div>
        </div>
        <div class="form-block-rcl">
            <div class="default-field">
                <input required type="password" placeholder="password" value="<?php echo $_REQUEST['user_pass']; ?>" name="user_pass">
            </div>
        </div>

        <?php do_action( 'login_form' ); ?>


        <div class="input-container">
            <input type="submit" class="recall-button link-tab-form" name="submit-login" value="<?php _e('SIGN IN','wp-recall'); ?>">


            <a href="#" class="link-remember-rcl link-tab-rcl "><?php _e('Recover my password','wp-recall'); ?></a>

            <?php echo wp_nonce_field('login-key-rcl','_wpnonce',true,false); ?>
            <input type="hidden" name="redirect_to" value="<?php rcl_referer_url('login'); ?>">
        </div>

    </form>
</div>
Закрыть