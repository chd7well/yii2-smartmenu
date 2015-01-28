<?php

namespace julatools\smartmenu\models;

use Yii;

/**
 * This is the model class for table "{{%sys_menu}}".
 *
 * @property integer $ID
 * @property string $label
 * @property string $url
 * @property integer $parent_ID
 * @property string $comment
 * @property integer $weight
 * @property integer $type_ID
 * @property integer $noguest
 *
 * @property Menu $parent
 * @property Menu[] $menus
 * @property SysMenuType $type
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['url'], 'string'],
            [['parent_ID', 'weight', 'type_ID', 'noguest'], 'integer'],
            [['label', 'comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'label' => Yii::t('configmanager', 'Label'),
            'url' => Yii::t('configmanager', 'Url'),
            'parent_ID' => Yii::t('configmanager', 'Parent  ID'),
            'comment' => Yii::t('configmanager', 'Comment'),
            'weight' => Yii::t('configmanager', 'Weight'),
            'type_ID' => Yii::t('configmanager', 'Type  ID'),
            'noguest' => Yii::t('configmanager', 'Noguest'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['ID' => 'parent_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(SysMenuType::className(), ['ID' => 'type_ID']);
    }
}