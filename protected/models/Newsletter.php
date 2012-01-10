<?php

/**
 * @property string $id
 * @property string $subject
 * @property string $message
 * @property string $sent
 * @property string $created
 */
class Newsletter extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'newsletters';
    }

    public function rules() {
        return array(
            array('subject, message', 'required'),
            array('subject', 'length', 'max' => 250),
            array('sent', 'safe'),
            array('id, subject, message, start, sent, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'users' => array(self::HAS_MANY, 'NewsletterUser', 'newsletter_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'subject' => 'Subject',
            'message' => 'Message',
            'start' => 'Start',
            'sent' => 'Sent',
            'created' => 'Created',
        );
    }
    
    public function scopes() {
        return array(
            'notSent' => array(
                'condition' => "sent is null"
            ),
        );
    }
    
}