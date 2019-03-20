<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%tb_mt_absen}}".
 *
 * @property int           $id_absen
 * @property int           $id_jenis_absen
 * @property int           $id_pegawai
 * @property string        $tgl_absen
 * @property string        $masuk_kerja
 * @property string        $pulang_kerja
 * @property string        $terlambat_kerja
 * @property string        $pulang_awal
 * @property TbMJenisAbsen $jenisAbsen
 * @property TbMPegawai    $pegawai
 */
class Absen extends \yii\db\ActiveRecord
{
    public $tgl_awal;
    public $tgl_akhir;
    public $ket;
    public $id_absen_terlambat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_mt_absen}}';
    }

    /**
     * {@inheritdoc}
     */

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            if (!is_null($this->pegawai)) {
                $id_satuan_kerja = $this->pegawai->id_satuan_kerja;
                if ($this->jenisAbsen->status_hadir =='Hadir') {
                    \Yii::$app->db->createCommand("update tb_m_satuan_kerja set tanggal_absen_terakhir = '" . $this->tgl_absen . "' where id_satuan_kerja=$id_satuan_kerja and coalesce(tanggal_absen_terakhir,'1990-1-1') < '" . $this->tgl_absen . "'")->execute();
                }
            }
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['Cuti'] = ['id_jenis_absen','id_pegawai','tgl_absen','tgl_awal','tgl_akhir','file_pendukung','alasan'];//Scenario Values Only Accepted
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['id_jenis_absen', 'id_pegawai', 'tgl_absen'], 'required'],
            [['id_jenis_absen', 'id_pegawai'], 'integer'],
            [['masuk_kerja', 'pulang_kerja', 'tgl_awal', 'tgl_akhir' , 'id_absen_terlambat'], 'safe'],
            [['alasan'], 'string'],
            [['file_pendukung'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,doc,docx,txt,,xls,xlsx', 'maxSize' => 512000000],
            [['file_pendukung','alasan'], 'required', 'on' =>'Cuti'],
         //   [['masuk_kerja', 'pulang_kerja'], 'datetime', 'format' => 'php:H:i:s'],
            [['terlambat_kerja', 'pulang_awal'], 'number'],
            [['masuk_kerja'], 'hitungJamTerlambat'],
            [['pulang_kerja'], 'hitungJamPulang'],

            [['id_jenis_absen'], 'exist', 'skipOnError' => true, 'targetClass' => JenisAbsen::className(), 'targetAttribute' => ['id_jenis_absen' => 'id_jenis_absen']],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'tgl_absenBeforeSave' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'tgl_absen',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'tgl_absen',
                ],

                'value' => function () {
                    return implode('-', array_reverse(explode('-', $this->tgl_absen)));
                },
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_absen' => Yii::t('app', 'Id Absen'),
            'id_jenis_absen' => Yii::t('app', ' Jenis Absen'),
            'id_pegawai' => Yii::t('app', ' Pegawai'),
            'tgl_absen' => Yii::t('app', 'Tgl Absen'),
            'masuk_kerja' => Yii::t('app', 'Masuk Kerja'),
            'pulang_kerja' => Yii::t('app', 'Pulang Kerja'),
            'terlambat_kerja' => Yii::t('app', 'Terlambat Kerja (Jam)'),
            'pulang_awal' => Yii::t('app', 'Pulang Awal (Jam)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function hitungJamTerlambat($attribute, $params)
    {
        $hari = date('w', strtotime($this->tgl_absen)) -1;
        if ($this->jenisAbsen->status_hadir == 'Hadir') {
            $shift = DetShift::find()->where(['id_shift' => $this->pegawai->id_shift, 'hari' => $hari])->one();
            if ($hari == 4) {
                $toleransi = 1;
            } else {
                $toleransi = 0.5;
            }
            //die(var_dump((strtotime($this->masuk_kerja) - strtotime($shift->jam_masuk))/3600));
            if (!is_null($shift)) {
                if (((strtotime($this->masuk_kerja) - strtotime($shift->jam_masuk)) / 3600) < -1 * $toleransi) {
                    $this->alasan = "Masuk Sebelum Toleransi Pukul: ".$this->masuk_kerja;
                    $this->masuk_kerja = null;
                    $this->terlambat_kerja = 0;
                } elseif (((strtotime($this->masuk_kerja) - strtotime($shift->jam_masuk)) / 3600) > 0.001) {
                    $this->terlambat_kerja = ceil((strtotime($this->masuk_kerja) - strtotime($shift->jam_masuk)) / 3600);
                } else {
                    $this->terlambat_kerja = 0;
                }
            } else {
                $this->terlambat_kerja =0;
            }
        } else {
            if ($this->scenario !== 'Cuti') {
                $this->masuk_kerja = '00:00';
                $this->terlambat_kerja = 0;
            }
        }

        return true;
    }

    public function hitungJamPulang($attribute, $params)
    {
        $hari = date('w', strtotime($this->tgl_absen));
        if ($this->jenisAbsen->status_hadir == 'Hadir') {
            $shift = DetShift::find()->where(['id_shift' => $this->pegawai->id_shift, 'hari' => $hari])->one();
            //  die(var_dump((strtotime($this->masuk_kerja) - strtotime($shift->jam_masuk))/60));
            if (!is_null($shift)) {
                if (((strtotime($this->pulang_kerja) - strtotime($shift->jam_pulang)) / 3600) < 0) {
                    $this->pulang_awal = ceil(abs(strtotime($shift->jam_pulang) - strtotime($this->pulang_kerja)) / 3600);
                } else {
                    $this->pulang_awal = 0;
                }
            } else {
                $this ->pulan_awal=0;
            }
        } else {
            if ($this->scenario !== 'Cuti') {
                $this->pulang_kerja = '00:00';
                $this->pulang_awal = 0;
            }
        }

        return true;
    }

    public function getJenisAbsen()
    {
        return $this->hasOne(JenisAbsen::className(), ['id_jenis_absen' => 'id_jenis_absen']);
    }

    public function getNama_jenis_absen()
    {
        return is_null($this->jenisAbsen) ? '' : $this->jenisAbsen->nama_jenis_absen;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }

    public function getNama_pegawai()
    {
        return is_null($this->pegawai) ? '' : '' . $this->pegawai->nama_lengkap;
    }

    public function getNip()
    {
        return is_null($this->pegawai) ? '' : '' . $this->pegawai->nip;
    }

    public function upload($fieldName)
    {
        $path = Yii::getAlias('@app') . '/web/media/';

        //s  die($fieldName);
        $image = UploadedFile::getInstance($this, $fieldName);

        if (!empty($image) && $image->size !== 0) {
            $fileNames = 'Absen' . $this->id_pegawai . $this->tgl_absen . md5(microtime()) . '.' . $image->extension;
            if ($image->saveAs($path . $fileNames)) {
                $this->attributes = [$fieldName => $fileNames];

                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
