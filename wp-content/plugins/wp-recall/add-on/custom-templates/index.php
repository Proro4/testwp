<?php

function overwatch_auth_form()
{
    global $user_ID,$rcl_user_URL,$rcl_options,$typeform;
    $typeform = $form;
    ob_start();
    echo '<div class="panel_lk_recall '.$type.'">';

    if($type=='floatform') echo '<a href="#" class="close-popup"><i class="fa fa-times-circle"></i></a>';
    if($user_ID){

        echo '<div class="buttons">';

        $buttons = '<p>'.rcl_get_button(__('In personal account','wp-recall'),$rcl_user_URL,array('icon'=>'fa-home')).'</p>
                            <p>'.rcl_get_button(__('Exit','wp-recall'),wp_logout_url( home_url() ),array('icon'=>'fa-external-link')).'</p>';
        echo apply_filters('buttons_widget_rcl',$buttons);

        echo '</div>';

    }else{

        $login_form = (isset($rcl_options['login_form_recall']))? $rcl_options['login_form_recall']: 0;

        if($login_form==1&&$type!='pageform'){

            $redirect_url = rcl_format_url(get_permalink($rcl_options['page_login_form_recall']));

            echo '<div class="buttons">';

            $buttons = '<p>'.rcl_get_button(__('Entry','wp-recall'),$redirect_url.'action-rcl=login',array('icon'=>'fa-sign-in')).'</p>
                            <p>'.rcl_get_button(__('Registration','wp-recall'),$redirect_url.'action-rcl=register',array('icon'=>'fa-book')).'</p>';
            echo apply_filters('buttons_widget_rcl',$buttons);

            echo '</div>';

        }else if($login_form==2){
            echo '<div class="buttons">';
            $buttons = '<p>'.rcl_get_button(__('Entry','wp-recall'),esc_url(wp_login_url('/')),array('icon'=>'fa-sign-in')).'</p>
                            <p>'.rcl_get_button(__('Registration','wp-recall'),esc_url(wp_registration_url()),array('icon'=>'fa-book')).'</p>';
            echo apply_filters('buttons_widget_rcl',$buttons);
            echo '</div>';
        }else if($login_form==3||$type){
            if($typeform!='register'){
                rcl_include_template('form-sign.php');
            }
            if($typeform!='sign'){
                rcl_include_template('form-register.php');
            }
            if(!$typeform||$typeform=='sign'){
                rcl_include_template('form-remember.php');
            }
        }else if(!$login_form){
            echo '<div class="buttons">';
            $buttons = '<p>'.rcl_get_button(__('Entry','wp-recall'),'#',array('icon'=>'fa-sign-in','class'=>'rcl-login')).'</p>
                                <p>'.rcl_get_button(__('Registration','wp-recall'),'#',array('icon'=>'fa-book','class'=>'rcl-register')).'</p>';
            echo apply_filters('buttons_widget_rcl',$buttons);
            echo '</div>';
        }

    }

    echo '</div>';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

//hooks
add_action ( 'rcl_get_authorize_form', 'overwatch_auth_form' );