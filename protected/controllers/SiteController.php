<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
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
	
	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('index', 'view', 'followView'),
				'users' => array('*'),
			),
		);
	}

	/**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
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
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Displays the follow page
     */
    public function actionFollow()
    {
        Yii::import('application.models.Country');
        Yii::import('application.models.Email');
        $model = new Follow();
		
		
		
        // collect user input data		
		if(isset($_POST['ajax'])) {
			if ($_POST['ajax'] == 'follow-form') {
				$model->attributes = $_POST['Follow'];
				if ($model->country == 'USA') {
					$model->setScenario('usa_country');
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}

				echo CActiveForm::validate($model);
			}
			Yii::app()->end();
		} else {
			if (isset($_POST['Follow'])) {
				$model->attributes = $_POST['Follow'];
				$mails = $_POST['Follow']['email'];
				foreach ($mails as $mail) {
					$model->email = $mail;
					$model->validate();
				}
				$model->email = $mails;
//				CVarDumper::dump($model->attributes);
				if ($model->save()) {					
					$this->redirect('view');
				}
			}
		}		
		
		// display the follow form
		$render = Yii::app()->getRequest()->getIsAjaxRequest() ? 'renderPartial' : 'render';
        $this->$render('follow', array('model' => $model, 'country' => CHtml::listData(Country::model()->findAllName(),'name', 'name')));
		
    }
	
	public function actionView() {
		$dataProvider = new CArrayDataProvider(Follow::model()->findAll(), array(
			'pagination' => array(
				'pageSize' => 10,
			),
		));
		$this->render('follow_view', array('dataProvider'=>$dataProvider));
	}
	

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
