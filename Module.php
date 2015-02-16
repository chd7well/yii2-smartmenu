<?php
/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/> by CHD Electronic Engineering
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace chd7well\smartmenu;

use chd7well\smartmenu\models\Menu;
/*
* @author Christian Dumhart <christian.dumhart@chd.at>
*/
class Module extends \yii\base\Module
{
	
	private $menus=[]; //node: weight, [ID, label, url, comment, noguest]

	
	public function init()
	{
		parent::init();

		// ...  other initialization code ...
		
		\Yii::$container->set("chd7well\\smartmenu\\models\\Menu", 'chd7well\smartmenu\models\Menu');
		
		if(isset(\Yii::$app->params['chd7well/smartmenu/onlymainmenu']) && \Yii::$app->params['chd7well/smartmenu/onlymainmenu'] ==0 )
		{//all menues are used
			$menuitems = Menu::findAll()->all();
		}
		else {
			$menuitems = Menu::findAll(['type_ID'=>1, 'parent_ID'=>null]);
		}
		if(isset($menuitems)){
		foreach($menuitems as $menuitem)
		{
			$submenus = Menu::find()->where(['type_ID'=>1, 'parent_ID'=>$menuitem->ID])->orderBy('weight')->all();
			if(isset($submenus))
			{
				$smenu = [];
				foreach($submenus as $submenu)
				{
					$smenu[] = ['label'=>$submenu['label'], 'url'=>$submenu['url']];
				}
				$this->addItem($menuitem->label, $menuitem->url, $menuitem->weight, $menuitem->comment, $menuitem->noguest, $menuitem->parent_ID, $menuitem->type_ID, $smenu);
			}
			else
			{
				$this->addItem($menuitem->label, $menuitem->url, $menuitem->weight, $menuitem->comment, $menuitem->noguest, $menuitem->parent_ID, $menuitem->type_ID);
			}
		}
		}
	}
	
	public function addItem($label, $url, $weight, $comment="", $noguest=false, $parent=0, $type=1, $submenu=null)
	{
		$retweight = 0;
		if($parent == 0)
		{
			if(isset($this->menus[$type]))
			{
				if(isset($this->menus[$type][$weight]))
				{
					for($dummy = 0; $dummy < 100; $dummy++)
					{
						if(!isset($this->menus[$type][$weight + $dummy]))
						{
							$retweight = $weight+$dummy;
							$node = [$weight+$dummy=>['ID'=>$retweight, 'label'=>$label, 'url'=>$url, 'comment'=>$comment, 'noguest'=>$noguest, 'items'=>$submenu]];
							$this->menus[$type] += $node; 
							ksort($this->menus[$type]);
							$dummy = 100;
							
						}
					}
				}
				else 
				{
					$retweight = $weight;
					$node = [$weight=>['ID'=>$retweight, 'label'=>$label, 'url'=>$url, 'comment'=>$comment, 'noguest'=>$noguest, 'items'=>$submenu]];
					$this->menus[$type] += $node;
					ksort($this->menus[$type]);
				}
				
			}	
			else {
				$retweight=$weight;
				$node = [$weight=>['ID'=>$retweight, 'label'=>$label, 'url'=>$url, 'comment'=>$comment, 'noguest'=>$noguest, 'items'=>$submenu]];
				$this->menus[$type] = $node;
			}
		}
		else {
			//not implemented yet.
		}
		
		return $retweight;
	}
	
	public function getItems($type=1)
	{
		return $this->menus[$type];
	}
	
	public function getNavbarItems($type=1)
	{
		$items = [];
		foreach($this->menus[$type] as $item)
		{
			if((!\Yii::$app->user->isGuest) || (\Yii::$app->user->isGuest && $item['noguest']==0))
			{
				if(isset($item['items']) && $item['items']!=null)
				{
					$items[] = ['label'=>$item['label'], 'url'=>$item['url'], 'items'=>$item['items']];
				}
				else {
					$items[] = ['label'=>$item['label'], 'url'=>$item['url']];
				}
			}
		}
		return $items;
	}
	/** @var array Model map */
	public $modelMap = [];
	/**
	 * @var string The prefix for user module URL.
	 * @See [[GroupUrlRule::prefix]]
	 */
	public $urlPrefix = 'smartmenu';
}