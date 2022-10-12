<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property string $usuCodigo
 * @property string $correo
 * @property string $contrasena
 * @property string $cedula
 * @property string $nombre1
 * @property string $apellido1
 * @property string $edad
 * @property string $nivelInstruccion
 * @property string $tipoDiscapacidad
 * @property string $nivelEducacion
 * @property string $tipoEscuela
 * @property string $estado
 * @property string $rolCodigo
 * @property string $insCodigo
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const ESTADO = "N";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuarios}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'usuCodigo',
            'correo',
            'contrasena',
            'cedula',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'edad',
            'nivelInstruccion',
            'tipoDiscapacidad',
            'nivelEducacion',
            'tipoEscuela',
            'estado',
            'rolCodigo',
            'insCodigo',
            'auth_key',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'ID'),
            'usu_correo' => Yii::t('app', 'Correo electrónico'),
            'nombre1' => Yii::t('app', 'Nombre'),
            'apellido1' => Yii::t('app', 'Apellido'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        if (is_array($id)) {
            $id = $id['$oid'];
        }
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @param string $institucion
     * @return static|null
     */
    public static function findByUsername($username, $institucion)
    {
        return User::find()->where([
            'insCodigo' => $institucion,
            'correo' => $username,
            'estado' => 'N',
        ])->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $validado = false;
        if ($this->contrasena == $password) {
            $validado = true;
        }
        return $validado;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->contrasena = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function roleInArray($arr_role)
    {
        return in_array(Yii::$app->user->identity->rolCodigo, $arr_role);
    }

    public static function isActive()
    {
        return Yii::$app->user->identity->estado == self::ESTADO;
    }
}
