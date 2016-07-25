<?php

namespace c006\cms\migrations;

use Yii;
use yii\db\Migration;

class m000000_000000_c006_email extends Migration
{

    /**
     *  ~ Console command ~
     *
     * php yii migrate --migrationPath=@vendor/c006/yii2-email/migrations
     *
     */

    /**
     *
     */
    public function up()
    {

        self::down();

        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('email_templates', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%email_templates}}', [
                    'id'            => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0               => 'PRIMARY KEY (`id`)',
                    'name'          => 'VARCHAR(100) NOT NULL',
                    'template_name' => 'VARCHAR(100) NOT NULL',
                    'email_from'    => 'VARCHAR(60) NOT NULL',
                    'updated'       => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
                    'html'          => 'TEXT NOT NULL',
                    'is_html'       => 'TINYINT(1) NULL DEFAULT \'1\'',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('email_template_fonts', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%email_template_fonts}}', [
                    'id'          => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0             => 'PRIMARY KEY (`id`)',
                    'template_id' => 'INT(11) UNSIGNED NOT NULL',
                    'name'        => 'VARCHAR(100) NOT NULL',
                    'font'        => 'VARCHAR(200) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('email_template_files', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%email_template_files}}', [
                    'id'          => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0             => 'PRIMARY KEY (`id`)',
                    'template_id' => 'INT(10) UNSIGNED NOT NULL',
                    'name'        => 'VARCHAR(100) NOT NULL',
                    'file'        => 'VARCHAR(60) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('email_template_css', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%email_template_css}}', [
                    'id'          => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0             => 'PRIMARY KEY (`id`)',
                    'template_id' => 'INT(10) UNSIGNED NOT NULL',
                    'selector'    => 'VARCHAR(45) NOT NULL',
                    'css'         => 'TEXT NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        $this->createIndex('idx_template_id_627_00', 'email_template_fonts', 'template_id', 0);
        $this->createIndex('idx_template_id_6289_01', 'email_template_files', 'template_id', 0);
        $this->createIndex('idx_template_id_6307_02', 'email_template_css', 'template_id', 0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_email_templates_6189_00', '{{%email_template_fonts}}', 'template_id', '{{%email_templates}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_email_templates_6285_01', '{{%email_template_files}}', 'template_id', '{{%email_templates}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_email_templates_6304_02', '{{%email_template_css}}', 'template_id', '{{%email_templates}}', 'id', 'CASCADE', 'NO ACTION');
        $this->execute('SET foreign_key_checks = 1;');

        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%email_templates}}', ['id' => '1', 'name' => 'Sign Up', 'template_name' => 'sign-up', 'email_from' => 'jchambers.dev@gmail.com', 'updated' => '2015-09-13 01:34:48', 'html' => '
TheTruthTree.org
Hi {FNAME}
, thank you for signing up.

Account login: {DOMAIN}/user

TheTruthTree.org
', 'is_html' => '1']);
        $this->insert('{{%email_templates}}', ['id' => '2', 'name' => 'Login Update', 'template_name' => 'login-update', 'email_from' => 'jchambers.dev@gmail.com', 'updated' => '2015-08-24 14:26:31', 'html' => '.', 'is_html' => '0']);
        $this->insert('{{%email_templates}}', ['id' => '3', 'name' => 'Order Receipt', 'template_name' => 'order-receipt', 'email_from' => 'jchambers.dev@gmail.com', 'updated' => '2015-08-24 14:28:08', 'html' => '.', 'is_html' => '1']);
        $this->insert('{{%email_templates}}', ['id' => '4', 'name' => 'Subscript Update', 'template_name' => 'subscription-update', 'email_from' => 'jchambers.dev@gmail.com', 'updated' => '2015-08-24 14:29:48', 'html' => '.', 'is_html' => '1']);
        $this->insert('{{%email_template_files}}', ['id' => '2', 'template_id' => '1', 'name' => 'Header', 'file' => '0-73995400-1440463633.jpg']);
        $this->insert('{{%email_template_css}}', ['id' => '1', 'template_id' => '1', 'selector' => '.bold', 'css' => 'font-weight: bold;']);
        $this->insert('{{%email_template_css}}', ['id' => '2', 'template_id' => '1', 'selector' => '.table', 'css' => 'display:table;
width:100%;
padding:0;
margin:0;']);
        $this->insert('{{%email_template_css}}', ['id' => '3', 'template_id' => '1', 'selector' => '.footer', 'css' => '  display          : block;
  margin           : 0;
  padding          : 3px;
  color            : #FFFFFF;
  background-color : #698E65;']);
        $this->execute('SET foreign_key_checks = 1;');


    }

    /**
     *
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `email_templates`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `email_template_fonts`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `email_template_files`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `email_template_css`');
        $this->execute('SET foreign_key_checks = 1;');


    }

}