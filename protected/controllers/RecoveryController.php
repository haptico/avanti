<?php

class RecoveryController extends Controller {

    public $defaultAction = 'recovery';

    /**
     * Recovery password
     */
    public function actionRecovery() {
        $form = new UserRecoveryForm;
        if (Yii::app()->user->id) {
            $this->redirect($this->returnUrl);
        } else {
            $email = ((isset($_GET['email'])) ? $_GET['email'] : '');
            $activkey = ((isset($_GET['activkey'])) ? $_GET['activkey'] : '');
            if ($email && $activkey) {
                $form2 = new UserChangePassword;
                $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
                if (isset($find) && $find->activkey == $activkey) {
                    if (isset($_POST['UserChangePassword'])) {
                        $form2->attributes = $_POST['UserChangePassword'];
                        if ($form2->validate()) {
                            $find->password = User::model()->encrypting($form2->password);
                            $find->activkey = User::model()->encrypting(microtime() . $form2->password);
                            if ($find->status == 0 || $find->status == 2) {
                                $find->status = 1;
                            }
                            $find->save();
                            Yii::app()->user->setFlash('recoveryMessage', Yii::t("user", "New password is saved."));
                            $this->redirect($this->recoveryUrl);
                        }
                    }
                    $this->render('changepassword', array('form' => $form2));
                } else {
                    Yii::app()->user->setFlash('recoveryMessage', Yii::t("user", "Incorrect recovery link."));
                    $this->redirect(Yii::app()->controller->module->recoveryUrl);
                }
            } else {
                if (isset($_POST['UserRecoveryForm'])) {
                    $form->attributes = $_POST['UserRecoveryForm'];
                    if ($form->validate()) {
                        $user = User::model()->notsafe()->findbyPk($form->user_id);
                        $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl(implode($this->recoveryUrl), array("activkey" => $user->activkey, "email" => $user->email));

                        $subject = Yii::t("user", "You have requested the password recovery site {site_name}", array(
                                    '{site_name}' => Yii::app()->name,
                        ));
                        $message = Yii::t("user", "You have requested the password recovery site {site_name}. To receive a new password, go to {activation_url}.", array(
                                    '{site_name}' => Yii::app()->name,
                                    '{activation_url}' => $activation_url,
                        ));

                        if ($this->sendMail($user->email, $subject, $message)) {
                            $user->status = 2;
                            $user->save();

                            Yii::app()->user->setFlash('recoveryMessage', Yii::t("user", "Please check your email. An instructions was sent to your email address."));
                            $this->refresh();
                        } else {
                            Yii::app()->user->setFlash('recoveryMessage', Yii::t("user", "Could not send the email password recovery. Please try again later."));
                            $this->refresh();
                        }
                    }
                }
                $this->render('recovery', array('form' => $form));
            }
        }
    }

}
