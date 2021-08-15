<?php

namespace common\models\mail;

use common\models\PorasMailer;
use Yii;

class ContactUs extends PorasMailer {
 
      public function defaultTo()
      {
          return ["okumfranq@gmail.com","fokumu@kumusoft.com"];
      }
 
      public function defaultSubject()
      {
          return 'TEST EMAIL FROM EOC';
      }
 
      public function defaultBodyHtml()
      {
          return 'This is a test email we are sending';
      }
  }
