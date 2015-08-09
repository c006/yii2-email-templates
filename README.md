Yii2 Alerts
===================



Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

`
php composer.phar require --prefer-dist "c006/yii2-alerts" "dev-master"
`

or add

`
"c006/yii2-alerts": "dev-master"
`

to the require section of your `composer.json` file.


Required
--------

+ ***jQuery***

+ **yii \ widgets \ Bootstrap**


Options
-------

**message =>**  {string}  
` Alert message (HTML) `

**alert_type =>**  {string}  
`      * alert-danger
       * alert-warning
       * alert-info
       * alert-success `

**close =>**  {boolean}  
` Show close link for alert `

**countdown =>**  {int}  
` Automatically remove alert in X seconds `



Usage
-----

Set message
>
    <?php
    Alerts::setMessage("Hello World");
    ?>

Display message
>
        <?= Alerts::widget([
                               'message'    => Alerts::getMessage(),
                               'alert_type' => 'alert-warning',
                               'close'      => TRUE,
                               'countdown'  => 5]); ?>





Comments / Suggestions
--------------------

Please provide any helpful feedback or requests.

Thanks.


































