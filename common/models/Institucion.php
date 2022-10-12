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
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['insCodigo', 'ubicación', 'insNombre'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'insNombre' => Yii::t('app', 'Nombre'),
    ];
  }

  public static function listarInstituciones()
  {
      $list = ArrayHelper::map(Institucion::findAll(['insEstado' => 'N']), function ($model_aux) {
          return (string)$model_aux->insCodigo;
      }, 'insNombre');

      $Opcion1 = array(null => "Seleccionar");
      $listCompleto = $Opcion1 + $list;

      return  $listCompleto;
  }
  
}