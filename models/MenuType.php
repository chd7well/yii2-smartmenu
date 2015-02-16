<?php
/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/> by CHD Electronic Engineering
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace chd7well\smartmenu\models;

use Yii;

/**
 * This is the model class for table "{{%sys_menu_type}}".
 *
 * @property integer $ID
 * @property string $type
 *
 * @property SysMenu[] $sysMenus
 * @author Christian Dumhart <christian.dumhart@chd.at>
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
            'ID' => Yii::t('smartmenu', 'ID'),
            'type' => Yii::t('smartmenu', 'Type'),
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