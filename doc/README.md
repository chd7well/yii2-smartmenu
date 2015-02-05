Guide to Yii2-smartmenu
==================

Quick Info
---------------
No documentation available in this state of deverlopment! 

The smartmenu module is a simple menu module which can generate a menu from database and also dynamical by adding the menu direct into the module. 
Each menu item can order per its weight. (e.g. -100 first, ...) We recommand to use 100 weight steps, for the 1st level entries, 10 weight steps for the 2nd level entries. 

Per default only the mainmenu will be activated. If you need more menu types, insert a new typ into sys_menu_type table and define follow parameters:
'7well/smartmenu/onlymainmenu' = 0.
If you use our 7well-configmanager activate this parameter as bootstrap!


Example:
```
NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            $mymod = \Yii::$app->getModule('smartmenu');
            $menuItems = array_merge($menuItems, $mymod->getNavbarItems());
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
```
> **NOTE:** Documentation is missing!

Getting Started
---------------

- [Installation](installation.md)
- [Configuration](configuration.md)
- [List of available actions](available-actions.md)

Overriding
----------

- [Overriding models](overriding-models.md)
- [Overriding views](overriding-views.md)
- [Overriding controllers](overriding-controllers.md)

Basics
------

- [User management](user-management.md)
- [Authentication via social networks](social-auth.md)
- [Mailer](mailer.md)

Guides
------

- [How to add captcha](adding-captcha.md)
