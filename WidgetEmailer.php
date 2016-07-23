<?php

namespace c006\email;

use c006\email\assets\Assets;
use c006\email\models\EmailTemplates;
use c006\email\models\Files;
use c006\user\models\User;
use Yii;
use yii\bootstrap\Widget;

/**
 * Class WidgetEmailer
 *
 * @package c006\WidgetEmailer
 */
class WidgetEmailer extends Widget
{

    /**
     * @var int
     */
    public $template_id = 0;
    /**
     * @var int
     */
    public $user_id = 0;

    /** @var array */
    public $array = [];

    /**
     * @return bool
     */
    function run()
    {
        if (!$this->template_id || !is_numeric($this->template_id)) {
            return FALSE;
        }

        if (!$this->user_id) {
            $this->user_id = Yii::$app->user->id;
        }

        if (!isset($this->array['email_to'])) {
            $this->array['email_to'] = self::getUser('email');
        }

        /** @var  $model \c006\email\models\EmailTemplates */
        $model = EmailTemplates::find()
            ->where(['id' => $this->template_id])
            ->one();

        if (!sizeof($model)) {
            return FALSE;
        }

        if (!isset($this->array['subject'])) {
            $this->array['subject'] = $model->name;
        }

        $body = $model->html;

        $body = self::matchReplacements($body);


        if ($model->is_html == FALSE) {
            $body = preg_replace("/(<\/?\w+)(.*?>)/e", "strtolower('\\1') . '\\2'", $body);
            $body = preg_replace("/<style[\w\W]+?style>/", '', $body);

            $body = strip_tags($body);
            $body = preg_replace('/\n(\s*\n){2,}/', PHP_EOL. PHP_EOL, $body);
//            $body = preg_replace("/^\\s+/m", PHP_EOL, $body);

//            die($body);

            /* MAILER */
            Yii::$app->mailer->compose()
                ->setTo($this->array['email_to'])
                ->setFrom($model->email_from)
                ->setSubject($this->array['subject'])
                ->setTextBody($body)
//                ->setCC(Yii::$app->params['supportEmail'])
                ->send();
        } else {
            /* MAILER */
            Yii::$app->mailer->compose()
                ->setTo($this->array['email_to'])
                ->setFrom($model->email_from)
                ->setSubject($this->array['subject'])
                ->setHtmlBody($body)
//                ->setCC(Yii::$app->params['supportEmail'])
                ->send();
        }

        return TRUE;
    }


    /**
     * @param $html
     *
     * @return mixed
     */
    private function matchReplacements($html)
    {
        $array = [];
        preg_match_all('/{.*?}/', $html, $matches);

        if (isset($matches[0])) {
            foreach ($matches[0] as $k => $v) {
                $array[ preg_replace('/[{|}]/', '', $v) ] = $v;
            }
        }

        foreach ($array as $k => $v) {
            if (substr($k, 0, 3) == "IMG") {
                $array[ $k ] = self::getImage(preg_replace('/[^0-9]/', '', $v));
            }
            if ($k == "FNAME") {
                $array[ $k ] = self::getUser('first_name');
            }
            if ($k == "LNAME") {
                $array[ $k ] = self::getUser('last_name');
            }
            if ($k == "SECURITY") {
                $array[ $k ] = (string)self::getUser('security') . '.' . substr(self::getUser('pin'), -4);
            }
            if ($k == "DOMAIN") {
                $array[ $k ] = self::getDomain();
            }
            if ($k == "SITE_NAME") {
                $array[ $k ] = self::getSiteName();
            }


            /* ~ CUSTOM */

            if ($k == "FUNDS_ADDED") {
                $array[ $k ] = $this->array['funds_added'];
            }
            if ($k == "BALANCE") {
                $array[ $k ] = $this->array['balance'];
            }
            if ($k == "TRANSACTION_ID") {
                $array[ $k ] = $this->array['transaction_id'];
            }
            if ($k == "MESSAGE") {
                $array[ $k ] = $this->array['message'];
            }
            if ($k == "TO") {
                $array[ $k ] = $this->array['to'];
            }
            if ($k == "SECURITY_KEY") {
                $array[ $k ] = $this->array['security_key'];
            }
            if ($k == "SECURITY_PIN") {
                $array[ $k ] = $this->array['security_pin'];
            }
            if ($k == "LINK") {
                $array[ $k ] = $this->array['link'];
            }

        }

        foreach ($array as $k => $v) {
            $html = str_replace('{' . $k . '}', $v, $html);
        }

        return $html;
    }


    /**
     * @param $id
     *
     * @return string
     */
    private function getImage($id)
    {
        $model = Files::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return Yii::$app->params['siteUrl'] . '/images/email/' . $model['file'];
        }

        return '';
    }

    /**
     * @param $column
     *
     * @return mixed|string
     */
    private function getUser($column)
    {
        $model = User::find()
            ->where(['id' => $this->user_id])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return $model[ $column ];
        }

        return '';
    }


    /**
     * @return mixed
     */
    private function getDomain()
    {
        return Yii::$app->params['siteUrl'];
    }

    /**
     * @return mixed
     */
    private function getSiteName()
    {
        return Yii::$app->params['siteName'];
    }


}
