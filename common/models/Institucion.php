<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for collection "Institucion".
 *
 * @property mixed $insCodigo
 * @property mixed $ubicación
 * @property mixed $insNombre
 */
class Institucion extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%institucion}}';
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      'insCodigo',
      'ubicación',
      'insNombre',
      'insEstado',
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
          'insCodigo',
          'ubicación',
          'insNombre',
          'insEstado'
        ], 'safe'
      ], [
        [
          'ubicación',
          'insNombre',
          'insEstado',
        ], 'required', 'message' => 'Campo obligatorio.', 'on' => 'registro'
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'insNombre' => Yii::t('app', 'Nombre'),
      'ubicación' => Yii::t('app', 'Ubicación'),
      'insEstado' => Yii::t('app', 'Estado de la institución'),
    ];
  }

  public static function listarInstituciones()
  {
    $list = ArrayHelper::map(Institucion::findAll(['insEstado' => Params::ESTADOOK]), function ($model_aux) {
      return (string)$model_aux->insCodigo;
    }, 'insNombre');

    $Opcion1 = array(null => "Seleccionar");
    $listCompleto = $Opcion1 + $list;

    return  $listCompleto;
  }

  /**
   * @return Institucion[]
   *
   */
  public static function BusquedaInstitucion(): array
  {
    return Institucion::find()
      ->where([
        'insEstado' => Params::ESTADOOK,
      ])->asArray()->all();
  }

  public static function listarInstitucionesFiltro()
  {
    $list = ArrayHelper::map(Institucion::findAll(['insEstado' => Params::ESTADOOK]), function ($model_aux) {
      return (string)$model_aux->insCodigo;
    }, 'insNombre');

    $Opcion1 = array(null => "Todos");
    $listCompleto = $Opcion1 + $list;

    return  $listCompleto;
  }

  public static function listaInstitucionDeterminada($insCodigoUsuario)
  {
    $list = ArrayHelper::map(Institucion::findAll(['insEstado' => Params::ESTADOOK, 'insCodigo' => $insCodigoUsuario]), function ($model_aux) {
      return (string)$model_aux->insCodigo;
    }, 'insNombre');
    $Opcion1 = array(null => "Seleccionar");
    $listCompleto = $Opcion1 + $list;

    return  $listCompleto;
  }

  public static function detectarInstituciones($rolCodigoUsuario, $insCodigoUsuario)
  {
    $listaInstituciones = [];
    $rolUsuario = Roles::BusquedaRol($rolCodigoUsuario);
    switch ($rolUsuario[0]['rolNumero']) {
      case '2':
        $listaInstituciones = self::listarInstituciones();
        break;
      default:
        $listaInstituciones = self::listaInstitucionDeterminada($insCodigoUsuario);
        break;
    }
    return $listaInstituciones;
  }
}
