Installation
============

This document will guide you through the process of installing Yii2-smartmenu using **composer**. Installation is a quick and
easy three-step process.

Step 1: Download Yii2-smartmenu using composer
-----------------------------------------

Add `"chd7well/yii2-smartmenu": "*"` to the require section of your **composer.json** file. And run `composer update`
to download and install Yii2-smartmenu.
Note: We recommanded to install the chd7well/yii2-configmanager.

Step 2: Configure your application
------------------------------------

> **NOTE:** Make sure that you don't have any `smartmenu` component configuration in your config files.

If you are useing the chd7well/configmanager add follow parameter:
parametername: "#smartmenu" => value: "['class' => 'chd7well\smartmenu\Module',]" => on bootstrap = true!
 
If you are useing normal configuration during php files add following lines to your main configuration file:

```php
'modules' => [
...
    'smartmenu' => [
            'class' => 'chd7well\smartmenu\Module' ,
    ],
]
```


Step 3: Update database schema
------------------------------

> **NOTE:** Make sure that you have properly configured **db** application component.

After you downloaded and configured Yii2-smartmenu, the last thing you need to do is updating your database schema by applying
the migrations:

```bash
$ php yii migrate/up --migrationPath=@vendor/chd7well/yii2-smartmenu/migrations
```
> **NOTE:** If you have installed also the chd7well/yii2-configmanager read and install first all parts of the chd7well/yii2-configmanager!

FAQ
---

**Installation failed. There are no files in `vendor/chd7well/yii2-smartmenu`**

*Try removing Yii2-smartmenu version constraint from composer.json, then run `composer update`. After composer finish
 removing of Yii2-smartmenu, re-add version constraint and `composer update` again.*

