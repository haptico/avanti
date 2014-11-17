<?php

class SiteController extends Controller {

    public $defaultAction = 'index';

    public function init() {
        parent::init();

        if (!Yii::app()->user->isGuest) {
            $this->defaultAction = 'admin';
        }
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdmin() {
        $this->render('admin');
    }

    public function actionLatLon() {
        echo('
            [
                {
                    "Id": 1,
                    "Latitude": -19.212355602107472,
                    "Longitude": -44.20234468749999,
                    "Descricao": "Conteúdo do InfoBox 1"
                },
                {
                    "Id": 2,
                    "Latitude": -22.618827234831404,
                    "Longitude": -42.57636812499999,
                    "Descricao": "Conteúdo do InfoBox 2"
                },
                {
                    "Id": 3,
                    "Latitude": -22.57825604463875,
                    "Longitude": -48.68476656249999,
                    "Descricao": "Conteúdo do InfoBox 3"
                },
                {
                    "Id": 4,
                    "Latitude": -17.082777073226872,
                    "Longitude": -47.10273531249999,
                    "Descricao": "Conteúdo do InfoBox 4"
                },
                {
                    "Id": 5,
                    "Latitude": -22.88936803353243,
                    "Longitude": -47.03139838867173,
                    "Descricao": "Conteúdo do InfoBox 5"
                },
                {
                    "Id": 6,
                    "Latitude": -22.88794472694071,
                    "Longitude": -47.08066520385728,
                    "Descricao": "Conteúdo do InfoBox 6"
                },
                {
                    "Id": 7,
                    "Latitude": -22.899488894308515,
                    "Longitude": -47.06023749999986,
                    "Descricao": "Conteúdo do InfoBox 7"
                },
                {
                    "Id": 8,
                    "Latitude": -22.882132704079144,
                    "Longitude": -47.060530090490715,
                    "Descricao": "Conteúdo do InfoBox 8"
                },
                {
                    "Id": 9,
                    "Latitude": -22.88045235311875,
                    "Longitude": -47.05914315872184,
                    "Descricao": "Conteúdo do InfoBox 9"
                },
                {
                    "Id": 10,
                    "Latitude": -22.87877194865705,
                    "Longitude": -47.05783424072257,
                    "Descricao": "Conteúdo do InfoBox 10"
                }
        ]');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $this->sendMail(Yii::app()->params['adminEmail'], $model->subject, $model->body);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

}
