<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use mdm\behaviors\ar\RelationTrait;

/**
 * This is the model class for table "tb_m_pegawai".
 *
 * @property int                  $id_pegawai
 * @property string               $nip
 * @property string               $nik
 * @property string               $nama
 * @property string               $gelar_depan
 * @property string               $gelar_belakang
 * @property string               $alamat
 * @property int                  $id_unit_kerja
 * @property int                  $id_jabatan_fungsional
 * @property string               $jenis_kelamin
 * @property string               $tempat_lahir
 * @property string               $tanggal_lahir
 * @property TbMJabatanFungsional $jabatanFungsional
 * @property TbMUnitKerja         $unitKerja
 */
class Pegawai extends \yii\db\ActiveRecord
{
    use RelationTrait;
    public $old_foto;
    public $old_tmt;
    public $old_file_sk_cpns;
    public $old_file_sk_pns;
    public $old_file_kartu_pegawai;
    public $old_file_sk_pangkat;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'tanggal_lahirBeforeSave' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'tanggal_lahir',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'tanggal_lahir',
                ],

                'value' => function () {
                    return $this->scenario=='payroll'? $this->tanggal_lahir :implode('-', array_reverse(explode('-', $this->tanggal_lahir)));
                },
            ],

            'tmtBeforeSave' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'tmt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'tmt',
                ],

                'value' => function () {
                    return $this->scenario=='payroll'? $this->tmt: implode('-', array_reverse(explode('-', $this->tmt)));
                },
            ],
        ];
    }

    public static function tableName()
    {
        return 'tb_m_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'id_shift', 'jenis_pegawai', 'tmt'], 'required'],
            [['alamat'], 'string'],
            [['id_unit_kerja', 'id_satuan_kerja', 'id_jabatan_fungsional', 'id_shift'], 'integer'],
            [['tanggal_lahir', 'id_jabatan_tambahan', 'id_atasan','status','gaji_pokok','gaji_lembur'], 'safe'],
            [['nip', 'gelar_depan', 'gelar_belakang'], 'string', 'max' => 50],
            [['nik'], 'string', 'max' => 50],
            [['nama', 'jenis_kelamin', 'tempat_lahir', 'kode_checklog'], 'string', 'max' => 255],
            [['foto', 'file_sk_pns', 'file_sk_cpns', 'file_kartu_pegawai', 'file_sk_pangkat', 'file_ijazah',
             'file_sp_tugas_belajar', 'file_sk_jabatan', 'file_sp_tugas', 'file_angka_kredit',
                    'file_sk_kenaikan_jabatan',
                    'file_sk_kenaikan_gaji_berkala',
                   'transkrip_nilai',
            ], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,bmp,jpeg', 'maxSize' => 512000000, 'maxFiles' => 15],

            [['id_jabatan_fungsional'], 'exist', 'skipOnError' => true, 'targetClass' => JabatanFungsional::className(), 'targetAttribute' => ['id_jabatan_fungsional' => 'id_jabatan_fungsional']],
            [['id_unit_kerja'], 'exist', 'skipOnError' => true, 'targetClass' => UnitKerja::className(), 'targetAttribute' => ['id_unit_kerja' => 'id_unit_kerja']],
            [['id_golongan'], 'exist', 'skipOnError' => true, 'targetClass' => Golongan::className(), 'targetAttribute' => ['id_golongan' => 'id_golongan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => Yii::t('app', 'Id Pegawai'),
            'id_shift' => Yii::t('app', 'Shift'),

            'nip' => Yii::t('app', 'Nip'),
            'nik' => Yii::t('app', 'Nik'),
            'nama' => Yii::t('app', 'Nama'),
            'gelar_depan' => Yii::t('app', 'Gelar Depan'),
            'gelar_belakang' => Yii::t('app', 'Gelar Belakang'),
            'alamat' => Yii::t('app', 'Alamat'),
            'id_unit_kerja' => Yii::t('app', 'Unit Kerja'),
            'id_jabatan_fungsional' => Yii::t('app', 'Jabatan'),
            'jenis_kelamin' => Yii::t('app', 'Jenis Kelamin'),
            'tempat_lahir' => Yii::t('app', 'Tempat Lahir'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'id_golongan' => 'Pangkat',
            'nama_golongan' => 'Pangkat',
            'tmt' =>'Tanggal Masuk',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['payroll'] = ['gaji_pokok','gaji_lembur'];//Scenario Values Only Accepted
	    return $scenarios;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatanFungsional()
    {
        return $this->hasOne(JabatanFungsional::className(), ['id_jabatan_fungsional' => 'id_jabatan_fungsional']);
    }

    public function getJabatanTambahan()
    {
        return $this->hasOne(JabatanTambahan::className(), ['id_jabatan_tambahan' => 'id_jabatan_tambahan']);
    }

    public function getNama_lengkap()
    {
        return $this->gelar_depan.' '.$this->nama.' '.$this->gelar_belakang;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitKerja()
    {
        return $this->hasOne(UnitKerja::className(), ['id_unit_kerja' => 'id_unit_kerja']);
    }

    public function getSatuanKerja()
    {
        return $this->hasOne(SatuanKerja::className(), ['id_satuan_kerja' => 'id_satuan_kerja']);
    }

    public function getShift()
    {
        return $this->hasOne(detShift::className(), ['id_shift' => 'id_shift']);
    }

    public function getGolongan()
    {
        return $this->hasOne(Golongan::className(), ['id_golongan' => 'id_golongan']);
    }

    public function getRiwayat_jabatan()
    {
        return $this->hasMany(RiwayatJabatan::className(), ['id_pegawai' => 'id_pegawai'])->orderBy('tmt desc');
    }

    public function getRiwayat_diklat()
    {
        return $this->hasMany(RiwayatDiklat::className(), ['id_pegawai' => 'id_pegawai'])->orderBy('tgl_mulai desc');
    }

    public function getPangkat()
    {
        return is_null($this->golongan) ? '' : $this->golongan->nama_golongan.' ( '.$this->golongan->kode_golongan.' )  ';
    }

    public function getKode_golongan()
    {
        return is_null($this->golongan) ? '' : $this->golongan->kode_golongan;
    }

    public function getNama_golongan()
    {
        return is_null($this->golongan) ? '' : $this->golongan->nama_golongan;
    }

    public function getNama_jabatan()
    {
        return is_null($this->jabatanFungsional) ? '' : $this->jabatanFungsional->nama_jabatan_fungsional;
    }

    public function getEselon()
    {
        if (!is_null($this->jabatanFungsional)) {
            return is_null($this->jabatanFungsional->eselon) ? '' : ' ( '.$this->jabatanFungsional->nama_eselon.' )';
        } else {
            return '';
        }
    }

    public function getNama_jabatan_tambahan()
    {
        return is_null($this->jabatanTambahan) ? '' : $this->jabatanTambahan->nama_jabatan;
    }

    public function getNama_unit_kerja()
    {
        return is_null($this->unitKerja) ? '' : $this->unitKerja->nama_unit_kerja;
    }

    public function getNama_satuan_kerja()
    {
        return is_null($this->satuanKerja) ? '' : $this->satuanKerja->nama_satuan_kerja;
    }

    public function upload($fieldName)
    {
        $path = Yii::getAlias('@app').'/web/media/';

        //s  die($fieldName);
        $image = UploadedFile::getInstance($this, $fieldName);

        if (!empty($image) && $image->size !== 0) {
            if ($this->nip !== '') {
                $fileNames = ($this->nip).'.'.$image->extension;
            } else {
                $fileNames = md5($this->id_pegawai).'.'.$image->extension;
            }
            if ($image->saveAs($path.$fileNames)) {
                $this->attributes = array($fieldName => $fileNames);

                return true;
            } else {
                return false;
            }
        } else {
            if ($fieldName === 'foto') {
                $this->attributes = array($fieldName => $this->old_foto);
            }

            return true;
        }
    }

    public function uploadKelengkapan($fieldName)
    {
        $path = Yii::getAlias('@app').'/web/media/kelengkapan/';
        //   die($fieldName);

        //s  die($fieldName);
        $image = UploadedFile::getInstance($this, $fieldName);

        if (!empty($image) && $image->size !== 0) {
            if ($this->nip !== '') {
                $fileNames = $fieldName.($this->nip).'.'.$image->extension;
            } else {
                $fileNames = $fieldName.md5($this->id_pegawai).'.'.$image->extension;
            }
            if ($image->saveAs($path.$fileNames)) {
                $this->attributes = array($fieldName => $fileNames);

                return true;
            } else {
                return false;
            }
        } else {
            if ($fieldName === 'file_sk_cpns') {
                $this->attributes = array($fieldName => $this->old_file_sk_cpns);
            }
            if ($fieldName === 'file_sk_pns') {
                $this->attributes = array($fieldName => $this->old_file_sk_pns);
            }
            if ($fieldName === 'file_kartu_pegawai') {
                $this->attributes = array($fieldName => $this->old_file_kartu_pegawai);
            }

            return true;
        }
    }

    public function uploadKelengkapanMultiple($fieldName)
    {
        $path = Yii::getAlias('@app').'/web/media/kelengkapan/';
        //   die($fieldName);
        $value = '';
        $images = UploadedFile::getInstances($this, $fieldName);
        if (count($images) > 0) {
            $path = Yii::getAlias('@app').'/web/media/';
            //   FileHelper::unlink($path . '*-' . md5($this->id_lokasi) . '*');
            $i = 0;
            foreach ($images as $image) {
                ++$i;
                if (!empty($image) && $image->size !== 0) {
                    $fileNames = $i.'-'.md5($this->id_pegawai)."-$fieldName".'.'.$image->extension;
                    if ($image->saveAs($path.$fileNames)) {
                        $value = $value.$fileNames.'&&';
                    } else {
                        return false;
                    }
                }
            }
        }
        if ($value !== '') {
            $this->attributes = array($fieldName => $value);
        }

        return true;
    }

    public function getAtasan()
    {
        return $this->hasOne(JabatanFungsional::className(), ['id_jabatan_fungsional' => 'id_atasan']);
    }

    public function getNama_atasan()
    {
        return is_null($this->atasan) ? '' : $this->atasan->nama_jabatan_fungsional;
    }

    public function getPegawai_atasan()
    {
        return $this->hasOne(Pegawai::className(), ['id_jabatan_fungsional' => 'id_atasan'])->where('id_satuan_kerja<>0 ');
    }

    public function getIs_atasan()
    {
        $pegawai = Pegawai::find()->select('id_pegawai')->where(['id_atasan' => $this->id_jabatan_fungsional])->one();

        return !is_null($pegawai);
    }

    public function getDetailFilePangkat()
    {
        return $this->hasMany(DetPegawaiFilePangkat::className(), ['id_pegawai' => 'id_pegawai'])->where("jenis='sk_pangkat'");
    }

    public function getDetailFileJabatan()
    {
        return $this->hasMany(DetPegawaiFileJabatan::className(), ['id_pegawai' => 'id_pegawai'])->where("jenis='sk_jabatan'");
    }
    public function getDetailFileSpmt()
    {
        return $this->hasMany(DetPegawaiFileSpmt::className(), ['id_pegawai' => 'id_pegawai'])->where("jenis='spmt'");
    }
    public function getDetailFileGaji()
    {
        return $this->hasMany(DetPegawaiFileGaji::className(), ['id_pegawai' => 'id_pegawai'])->where("jenis='sk_gaji'");
    }
    public function getDetailFileIjazah()
    {
        return $this->hasMany(DetPegawaiFileIjazah::className(), ['id_pegawai' => 'id_pegawai'])->where("jenis='ijazah'");
    }
    public function setDetailFilePangkat($value)
    {
        return $this->loadRelated('detailFilePangkat', $value);
    }

    public function setDetailFileJabatan($value)
    {
        return $this->loadRelated('detailFileJabatan', $value);
    }

    public function setDetailFileSpmt($value)
    {
        return $this->loadRelated('detailFileSpmt', $value);
    }

    public function setDetailFileGaji($value)
    {
        return $this->loadRelated('detailFileGaji', $value);
    }

    public function setDetailFileIjazah($value)
    {
        return $this->loadRelated('detailFileIjazah', $value);
    }

    public function getDetailPayrollTunjangan()
    {
        return $this->hasMany(DetPayrollTunjangan::className(), ['id_pegawai' => 'id_pegawai']);
    }
    public function setDetailPayrollTunjangan($value)
    {
        return $this->loadRelated('detailPayrollTunjangan', $value);
    }

    public function getDetailPayrollPotongan()
    {
        return $this->hasMany(DetPayrollPotongan::className(), ['id_pegawai' => 'id_pegawai']);
    }
    public function setDetailPayrollPotongan($value)
    {
        return $this->loadRelated('detailPayrollPotongan', $value);
    }
}
