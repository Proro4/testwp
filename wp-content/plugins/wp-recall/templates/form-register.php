<?php global $typeform;
$f_reg = ($typeform=='register')? 'style="display:block;"': ''; ?>
<div class="form-tab-rcl" id="register-form-rcl" <?php echo $f_reg; ?>>
    <h4 class="form-title"><?php _e('Registration','wp-recall'); ?></h4>

    <?php rcl_notice_form('register'); ?>

    <form action="<?php rcl_form_action('register'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-block-rcl">
            <div class="default-field">
                <input required type="text" placeholder="Login" value="<?php echo $_REQUEST['user_login']; ?>" name="user_login" id="login-user">
            </div>
        </div>
        <div class="form-block-rcl">
            <div class="default-field">
                <input required type="email" placeholder="E-mail" value="<?php echo $_REQUEST['user_email']; ?>" name="user_email" id="email-user">
            </div>
        </div>

        <?php do_action( 'register_form' ); ?>

        <div class="input-container">
            <input type="submit" class="recall-button link-tab-form" name="submit-register" value="<?php _e('Send','wp-recall'); ?>">
            <?php if(!$typeform){ ?>
                <a href="#" class="link-login-rcl link-tab-rcl"></a>
            <?php } ?>
            <?php echo wp_nonce_field('register-key-rcl','_wpnonce',true,false); ?>
            <input type="hidden" name="redirect_to" value="<?php rcl_referer_url('register'); ?>">
        </div>
    </form>
</div>