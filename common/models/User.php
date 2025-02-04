<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
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
            'usuEncargado',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
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
                    'usuEncargado'
                ], 'safe'
            ], [
                [
                    'nombre1',
                    'apellido1',
                    'edad',
                    'cedula',
                    'nivelInstruccion',
                    'tipoEscuela',
                    'rolCodigo',
                    'insCodigo',
                    'nivelEducacion',
                    'tipoDiscapacidad',
                    'estado',
                    'usuEncargado',
                    'correo',
                    'contrasena',
                ], 'required', 'message' => 'Campo obligatorio.', 'on' => 'registro'
            ],
            ['edad', 'validacionFecha', 'on' => 'registro'],
            ['correo', 'email', 'message' => 'Correo electrónico no es una dirección de correo electrónico válida.', 'on' => 'registro'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre1' => Yii::t('app', 'Nombre'),
            'apellido1' => Yii::t('app', 'Apellido'),
            'edad' => Yii::t('app', 'Fecha de nacimiento'),
            'cedula' => Yii::t('app', 'Cédula'),
            'nivelInstruccion' => Yii::t('app', 'Nivel de instrucción'),
            'tipoEscuela' => Yii::t('app', 'Tipo de institución'),
            'rolCodigo' => Yii::t('app', 'Tipo de usuario'),
            'insCodigo' => Yii::t('app', 'Institución'),
            'nivelEducacion' => Yii::t('app', 'Grado de Educación'),
            'tipoDiscapacidad' => Yii::t('app', 'Tipo de discapacidad'),
            'estado' => Yii::t('app', 'Estado del usuario'),
            'correo' => Yii::t('app', 'Correo electrónico'),
            'contrasena' => Yii::t('app', 'Contraseña'),
            'usuEncargado' => Yii::t('app', 'Encargado del usuario'),
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

    public function validacionFecha($attribute)
    {
        $hoy = date("Y-m-d");
        // Si la fecha es de apartir de hoy => true 
        if ($hoy >= $attribute) {
            $this->addError($attribute, 'La fecha no puede sobrepasar a la fecha actual.');
        }
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
        $usuario = User::find()->where([
            'correo' => $username,
            'estado' => 'N',
        ])->one();

        if (!is_null($usuario)) {
            $rolTomado = Roles::BusquedaRol($usuario->rolCodigo);
            if ($rolTomado[0]['rolNumero'] != '2') {
                $usuario = User::find()->where([
                    'insCodigo' => $institucion,
                    'correo' => $username,
                    'estado' => 'N',
                ])->one();
            }
        }

        return $usuario;
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
        if ($this->contrasena == hash('sha512', $password)) {
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

    public static function listarUsuarios($codigoInstitucion, $rolSeleccionado, $opcional = null)
    {
        $respuesta = new \stdClass;
        $respuesta->correcto = false;
        $respuesta->listCompleto = [];
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $rolTomado = Roles::BusquedaRol($rolUsuario);

        $respuestaConsulta = Self::realizarConsulta($rolSeleccionado);
        if ($respuestaConsulta->tipo == 'Profesor' && !is_null($opcional)) {
            $consulta = User::find()
                ->select(["usuCodigo", "nombre1", "apellido1"])
                ->where(['estado' => Params::ESTADOOK, 'usuCodigo' => Yii::$app->user->identity->usuCodigo])
                ->all();
        } else if ($respuestaConsulta->tipo != 'Super Administrador') {
            $consulta = User::find()
                ->select(["usuCodigo", "nombre1", "apellido1"])
                ->where(['estado' => Params::ESTADOOK, 'insCodigo' => $codigoInstitucion, 'rolCodigo' => $respuestaConsulta->rolBusqueda])
                ->all();
        } else {
            $consulta = User::find()
                ->select(["usuCodigo", "nombre1", "apellido1"])
                ->where(['estado' => Params::ESTADOOK, 'rolCodigo' => $respuestaConsulta->rolBusqueda])
                ->all();
        }

        $list = ArrayHelper::map($consulta, function ($model_aux) {
            return (string)$model_aux['usuCodigo'];
        }, function ($model_aux) {
            return $model_aux['nombre1'] . " " . $model_aux['apellido1'];
        });

        if (count($list) > 0) {
            $Opcion1 = array(null => "Seleccionar");
            $respuesta->listCompleto = $Opcion1 + $list;
            $respuesta->correcto = true;
        } else {
            if ($rolTomado[0]['rolNumero'] == '4' && $rolSeleccionado != "") {
                $respuesta->seleccionFaltante = "Profesor";
            } else {
                $respuesta->seleccionFaltante = $respuestaConsulta->tipo;
            }
        }

        return  $respuesta;
    }

    private static function realizarConsulta($rolSeleccionado)
    {
        $respuesta = new \stdClass;

        $DetallesRol = Roles::listarRoles();
        switch ($DetallesRol[$rolSeleccionado]) {
            case 'Administrador':
                $respuesta->rolBusqueda = array_search('Super Administrador', $DetallesRol);
                $respuesta->tipo = 'Super Administrador';
                break;
            case 'Profesor':
                $respuesta->rolBusqueda  = array_search('Administrador', $DetallesRol);
                $respuesta->tipo = 'Administrador';
                break;
            case 'Estudiante':
                $respuesta->rolBusqueda  = array_search('Profesor', $DetallesRol);
                $respuesta->tipo = 'Profesor';
                break;
            default:
                $respuesta->rolBusqueda  = 'No Existe';
                $respuesta->tipo = 'Ninguno';
                break;
        }
        return $respuesta;
    }

    /**
     * @return User[]
     *
     */
    public static function BusquedaUsuario(
        string $usuCodigo
    ): array {
        return User::find()
            ->where([
                'usuCodigo' => $usuCodigo,
            ])->asArray()->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function busquedaUsuarioCedula($Consulta)
    {
        return User::findOne($Consulta);
    }

    /**
     * {@inheritdoc}
     */
    public static function busquedaUsuarioCedulaPArametros($Consulta)
    {

        return (User::find()->where($Consulta)->all())[0] ?? null;
    }
}
