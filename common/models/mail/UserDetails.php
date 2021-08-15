<?php

namespace common\models\mail;

use common\models\UserMailer;
use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;

class UserDetails extends UserMailer {

    /**
     * Unique Identifier of a task
     * @var Int 
     */
    public $user_id;

    public function __construct($id) {
        $this->user_id = $id;
    }

    public function defaultTo() {
        return $this->getUser()->assignedTo->email;
    }

    public function defaultSubject() {
        return $this->getUser()->firstname . ' - USER ACCOUNT DETAILS';
    }

    public function defaultBodyHtml() {
        $msg = "<p>Your account has been created with the login credentials below;</p>" .
                 "<h4>Username: </h4>" . $this->getUser()->username  .
                "<h4>Password</h4>".$this->getUser()->username . 
               
                $msg .= "<hr/><p>Click here <a href='https://sacco.kumusoft.com'>login to the system here</a></p>";
        return $msg;
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    protected function getUser() {
        return User::find()->where(['id' => $this->user_id])->one();
    }

}
