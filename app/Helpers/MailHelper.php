<?php

namespace App\Helpers;

use App\Models\EmailConfiguration;

class MailHelper
{

    public static function setMailConfig(){

        $email_setting = EmailConfiguration::first();
        
        // Check if email configuration exists
        if (!$email_setting) {
            \Log::error('Email configuration not found in database');
            return false;
        }

        // Validate required fields
        if (empty($email_setting->mail_host) || empty($email_setting->mail_port) || 
            empty($email_setting->smtp_username) || empty($email_setting->smtp_password)) {
            \Log::error('Email configuration is incomplete');
            return false;
        }

        $mailConfig = [
            'transport' => 'smtp',
            'host' => $email_setting->mail_host,
            'port' => (int)$email_setting->mail_port,
            'encryption' => $email_setting->mail_encryption,
            'username' => $email_setting->smtp_username,
            'password' => $email_setting->smtp_password,
            'timeout' => null
        ];

        config(['mail.mailers.smtp' => $mailConfig]);
        config(['mail.from.address' => $email_setting->email]);
        
        \Log::info('Mail configuration set successfully', [
            'host' => $email_setting->mail_host,
            'port' => $email_setting->mail_port,
            'encryption' => $email_setting->mail_encryption
        ]);
        
        return true;
    }
}
