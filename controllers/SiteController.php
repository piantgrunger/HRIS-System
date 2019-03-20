<?php

namespace app\controllers;

use Yii;

use app\models\UbahPasswordForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\models\Pegawai;
use app\models\Absen;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndexUser()
    {
        return $this->render(
            'index-user'


        );
    }
    public function actionIndex()
    {
        $inbox=[];
        if ((is_null(Yii::$app->user->identity->pegawai))  || (!is_null(Yii::$app->user->identity->id_satuan_kerja))) {
            $data = [];
            $pns = Pegawai::find();
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $pns->andWhere("id_satuan_kerja=". Yii::$app->user->identity->id_satuan_kerja);
            }

            $pns=$pns->count();
            $data['pegawai'] = $pns;
     
            $masuk = Absen::find();
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $masuk ->innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai=tb_mt_absen.id_pegawai and id_satuan_kerja=" . Yii::$app->user->identity->id_satuan_kerja);
            }


            $masuk=$masuk->where(" tgl_absen= '".date('Y-m-d')."'")->andWhere('terlambat_kerja=0')
        ->andWhere("masuk_kerja <>'00:00'");

            $masuk =$masuk->count();
            $data['masuk'] = $masuk;
            $ijin = Absen::find()
        ->innerJoin('tb_m_jenis_absen', "tb_m_jenis_absen.id_jenis_absen = tb_mt_absen.id_jenis_absen and tb_m_jenis_absen.nama_jenis_absen='Ijin' ");
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $ijin->innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai=tb_mt_absen.id_pegawai and id_satuan_kerja=" . Yii::$app->user->identity->id_satuan_kerja);
            }


            $ijin = $ijin ->where(" tgl_absen= '".date('Y-m-d')."'")
        ->count();
            $data['ijin'] = $ijin;
            $terlambat = Absen::find();
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $terlambat ->innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai=tb_mt_absen.id_pegawai and id_satuan_kerja=" . Yii::$app->user->identity->id_satuan_kerja);
            }


            $terlambat=$terlambat->where(" tgl_absen= '".date('Y-m-d')."'")->andWhere('terlambat_kerja<>0')
        ->count();
            $data['terlambat'] = $terlambat;

            $pulang_cepat = Absen::find();
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $pulang_cepat -> innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai=tb_mt_absen.id_pegawai and id_satuan_kerja=" . Yii::$app->user->identity->id_satuan_kerja);
            }


            $pulang_cepat=$pulang_cepat->where(" tgl_absen= '".date('Y-m-d')."'")->andWhere('pulang_awal<>0')
        ->count();
            $data['pulang_cepat'] = $pulang_cepat;
            $absen_pulang = Absen::find();
            if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
                $absen_pulang ->innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai=tb_mt_absen.id_pegawai and id_satuan_kerja=" . Yii::$app->user->identity->id_satuan_kerja);
            }

            $absen_pulang = $absen_pulang ->where(" tgl_absen= '".date('Y-m-d')."'")->andWhere('pulang_kerja is null ')
        ->andWhere('masuk_kerja is not null ')
        ->count();
            $data['absen_pulang'] = $absen_pulang;
            $tidak_masuk = Absen::find()->where(" tgl_absen= '".date('Y-m-d')."'")
        ->count();
            $data['tidak_masuk'] = $pns  - $tidak_masuk;



            return $this->render(
                'index',
                ['data' => $data,
                ]

            );
        } else {
            return $this->render(
                'index-user'


        );
        }
    }

    public function actionMenu()
    {
        return $this->render('menu');
    }

    public function actionMenuUser()
    {
        return $this->render('menu-user');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     *
     * @return mixed
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionUbahPassword()
    {
        $model = new UbahPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Password Berhasil di Ubah');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
