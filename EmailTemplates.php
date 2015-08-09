<?php


namespace c006\email;

use c006\alerts\Alerts;
use c006\email\assets\Assets;
use Yii;
use yii\bootstrap\Widget;

/**
 * Class EmailTemplates
 *
 * @package c006\EmailTemplates
 */
class EmailTemplates extends Widget
{
    /** @var string */
    public $template = 'blank';

    public $text_email = TRUE;

    /** @var array */
    public $array = [];

    function run()
    {
        $test = ['email_to', 'email_from', 'subject'];
        foreach ($test as $item) {
            if (array_key_exists($item, $this->array) == FALSE) {
                Alerts::setMessage('EmailTemplates :: Missing :: ' . $item);
                Alerts::setAlertType(Alerts::ALERT_DANGER);

                return FALSE;
            }
        }

        $this->array['company_name'] = (isset($this->array['company_name'])) ? $this->array['company_name'] : 'c006 Development';
        $this->array['page_title'] = (isset($this->array['page_title'])) ? $this->array['page_title'] : '';
        $this->array['footer'] = (isset($this->array['footer'])) ? $this->array['footer'] : Assets::$FOOTER;
        $this->array['name'] = (isset($this->array['name'])) ? $this->array['name'] : '';

        $body = $this->render($this->template, ['array' => $this->array]);

        if ($this->text_email) {

            $body = preg_replace("/(<\/?\w+)(.*?>)/e", "strtolower('\\1') . '\\2'", $body);
            $body = str_replace('<div>', "<div>###P###", $body);
            $body = str_replace('<tr>', "<tr>###P###", $body);
            $body = str_replace('<p>', "<p>###P######P###", $body);
            $body = str_replace('<br>', "###P###", $body);
            $body = preg_replace("/<style[\w\W]+?style>/", '', $body);
            $body = strip_tags($body);
            $body = preg_replace('/[\s\t]+/', ' ', $body);
            $body = str_replace('###P###', PHP_EOL, $body);

//            die($body);

            /* MAILER */
            Yii::$app->mailer->compose()
                ->setTo($this->array['email_to'])
                ->setFrom([$this->array['email_from'] => (isset($this->array['email_from_name'])) ? $this->array['email_from_name'] : $this->array['email_from']])
                ->setSubject($this->array['subject'])
                ->setTextBody($body)
                ->setCC(Yii::$app->params['supportEmail'])
                ->send();
        } else {
            /* MAILER */
            Yii::$app->mailer->compose()
                ->setTo($this->array['email_to'])
                ->setFrom([$this->array['email_from'] => (isset($this->array['email_from_name'])) ? $this->array['email_from_name'] : $this->array['email_from']])
                ->setSubject($this->array['subject'])
                ->setHtmlBody($body)
                ->setCC(Yii::$app->params['supportEmail'])
                ->send();
        }

        return TRUE;
    }

}
