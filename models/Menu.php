<?php
/*
 * This file is part of the julatools project.
 *
 * (c) julatools project <http://github.com/julatools/> by CHD Electronic Engineering
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
 * @author Christian Dumhart <christian.dumhart@chd.at>
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
            'ID' => Yii::t('smartmenu', 'ID'),
            'label' => Yii::t('smartmenu', 'Label'),
            'url' => Yii::t('smartmenu', 'Url'),
            'parent_ID' => Yii::t('smartmenu', 'Parent  ID'),
            'comment' => Yii::t('smartmenu', 'Comment'),
            'weight' => Yii::t('smartmenu', 'Weight'),
            'type_ID' => Yii::t('smartmenu', 'Type  ID'),
            'noguest' => Yii::t('smartmenu', 'Noguest'),
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