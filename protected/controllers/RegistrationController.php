<?php

class RegistrationController extends Controller {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        $model = new RegistrationForm;

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo UActiveForm::validate(array($model));
            Yii::app()->end();
        }

        // Se tentar acessar essa action logado, é direcionado para o profile 
        if (Yii::app()->user->id) {
            $this->redirect($this->profileUrl);
        } else {
            if (isset($_POST['RegistrationForm'])) {
                $model->attributes = $_POST['RegistrationForm'];
                if ($model->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = User::model()->encrypting(microtime() . $model->password);
                    $model->password = User::model()->encrypting($model->password);
                    $model->verifyPassword = User::model()->encrypting($model->verifyPassword);
                    $model->superuser = 0;
                    $model->status = ((User::model()->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

                    if ($model->save()) {
                        if (User::model()->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/Activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                            $this->sendMail($model->email, Yii::t("user", "You registered from {site_name}", array('{site_name}' => Yii::app()->name)), Yii::t("user", "Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
                        }
                        if ((User::model()->loginNotActiv || (User::model()->activeAfterRegister && $this->sendActivationMail == false)) && User::model()->autoLogin) {
                            $identity = new UserIdentity($model->username, $soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity, 0);
                            $this->redirect($this->returnUrl);
                        } else {
                            if (!User::model()->activeAfterRegister && !User::model()->sendActivationMail) {
                                Yii::app()->user->setFlash('registration', Yii::t("user", "Thank you for your registration. Contact Admin to activate your account."));
                            } elseif (User::model()->activeAfterRegister && User::model()->sendActivationMail == false) {
                                Yii::app()->user->setFlash('registration', Yii::t("user", "Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(Yii::t("user", 'Login'), $this->loginUrl))));
                            } elseif (User::model()->loginNotActiv) {
                                Yii::app()->user->setFlash('registration', Yii::t("user", "Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration', Yii::t("user", "Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                }
            }
            $this->render('/user/registration', array('model' => $model));
        }
    }

}
