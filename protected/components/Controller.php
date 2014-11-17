<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController {

    public $registrationUrl = array("/Registration/");
    public $recoveryUrl = array("/Recovery/recovery");
    public $loginUrl = array("/Login/");
    public $logoutUrl = array("/Logout/logout");
    public $profileUrl = array("/user/profile");
    public $returnUrl = array("/");
    public $returnLogoutUrl = array("/Login/");

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/guest';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * Send mail method
     */
    public function sendMail($email, $subject, $message) {

        Yii::import('application.extensions.phpmailer.AvantiPhpMailer');
        $mail = new AvantiPhpMailer;
        $mail->IsSMTP();

        // Yii::app()->params['adminEmail']
        $mail->Subject = $subject;
        $mail->AltBody = wordwrap($message, 70);
        $mail->MsgHTML(str_replace("\n.", "\n..", $message));
        $mail->AddAddress($email);
        return $mail->Send();
    }

    public function init() {
        parent::init();

        if (!Yii::app()->user->isGuest) {
            $this->layout = '//layouts/admin';
        }
    }

}
