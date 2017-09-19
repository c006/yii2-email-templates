<?php

namespace c006\email\assets;

use c006\email\models\Css;
use c006\email\models\Files;

/**
 * Class AppHelper
 * @package c006\email\assets
 */
class AppHelper
{


    /**
     * @param $html
     *
     * @return mixed
     */
    static public function addImages($html)
    {
        $array = [];
        $url = '/images/email';
        preg_match_all('/\{IMG_[0-9]+}/', $html, $matches);

        if (sizeof($matches[0])) {
            foreach ($matches[0] as $k => $v) {
                $array[ $v ] = self::getImageFile(preg_replace('/[^0-9]/', '', $v));
            }
            foreach ($array as $k => $v) {
                $html = str_replace($k, $url . '/' . $v, $html);
            }
        }

        return $html;
    }


    static public function cleanCss($css)
    {
        $out = '';
        $max = 0;
        $min = 20;
        $array = [];
        foreach (explode(PHP_EOL, $css) as $line) {
            $css = $line;
            if (stripos($css, ':') !== FALSE) {
                list($a, $b) = explode(':', $css);
                $a = trim($a);
                $b = trim($b);
                if ($max < strlen($a)) {
                    $max = strlen($a);
                }
                if ($min > strlen($b)) {
                    $min = strlen($b);
                }
                $array[] = [$a, $b];
            }
        }

        foreach ($array as $item) {
            $len = $max - strlen($item[0]);
            $ratio = ceil($max / $min / 2);
            $ratio = ($ratio < 3) ? 3 : $ratio;
            $ratio = ($ratio > 3) ? 4 : $ratio;
            if (strlen($item[0]) == $max) {
                $out .= $item[0] . "\t: " . trim($item[1]) . PHP_EOL;
            } else {
                $out .= $item[0] . str_repeat("\t", ceil(($len + 1) / $ratio)) . ': ' . trim($item[1]) . PHP_EOL;
            }

        }

        return $out;
    }

    /**
     * @param $id
     *
     * @return bool|string
     */
    static public function getImageFile($id)
    {

        $model = Files::findOne($id);
        if (is_object($model)) {
            return $model->file;
        }

        return FALSE;
    }

    /**
     * @param int $id
     *
     * @return string
     */
    static public function getCss($id = 0)
    {
        $css = '';
        if ($id) {
            $model = Css::find()
                ->where(['id' => $id])
                ->asArray()
                ->one();
        } else {
            $model = Css::find()
                ->asArray()
                ->all();
        }
        foreach ($model as $item) {
            $css .= PHP_EOL . '.EmailTemplate ' . $item['selector'] . ' {';
            $css .= PHP_EOL . $item['css'];
            $css .= PHP_EOL . '}';
        }

        return $css;
    }

    /**
     * @param int $id
     *
     * @return bool|mixed
     */
    static public function getCssSelector($id = 0)
    {
        $model = Css::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return str_replace('.', '', $model['selector']);
        }

        return FALSE;
    }

    /**
     * @param $email_id
     *
     * @return int
     */
    static public function getCssSections($email_id)
    {
        if (!$email_id) {
            return 0;
        }
        $model = Css::find()
            ->where(['email_id' => $email_id])
            ->asArray()
            ->one();

        if (sizeof($model)) {
            return $model;
        }

        return [];
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getFonts()
    {
        $model = EmailTemplateFonts::find()
            ->asArray()
            ->all();

        if (sizeof($model)) {
            return $model;
        }

        return [];
    }
}