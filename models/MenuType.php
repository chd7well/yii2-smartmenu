<?php

namespace julatools\smartmenu\models;

use Yii;

/**
 * This is the model class for table "{{%sys_menu_type}}".
 *
 * @property integer $ID
 * @property string $type
 *
 * @property SysMenu[] $sysMenus
 */
class SysMenuType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_menu_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'type' => Yii::t('configmanager', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMenus()
    {
        return $this->hasMany(SysMenu::className(), ['type_ID' => 'ID']);
    }
}