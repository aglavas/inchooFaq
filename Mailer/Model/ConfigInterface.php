<?php

namespace Inchoo\Mailer\Model;


interface ConfigInterface
{
    const MAILER_ENABLE = 'mailer/email/send';
    const MAILER_RECIPIENT = 'mailer/email/recipient_email';
    const MAILER_TEMPLATE = 'mailer/email/email_template';

    public function isEnabled();


    public function emailTemplate();


    public function emailRecipient();

}