<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

use Mailgun\Mailgun;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Controller extends BaseController
{
    //
    protected function encodeUserToken($data)
    {
        $payload = [
            'iss' => "eRecruitment",  
            'sub' => $data["id"],  
            'iat' => time(),  
            'exp' => time() + env('JWT_EXPIRE_HOUR') * 60 * 60, // Expiration time
        ];
        return JWT::encode($payload, env('JWT_KEY'));
    }
    protected function decodeToken($token)
    { 
        try { 
            return JWT::decode($token, env('JWT_KEY'), explode(",", env('JWT_ALGORITHM')));
        } catch (ExpiredException $e) {  
            unset($_COOKIE['login_session_token']);
            setcookie('login_session_token', null, -1, '/'); 
            return response()->json([ 'error' => 'Provided token is expired.’', ], 403); 
        } catch (Exception $e) { 
            unset($_COOKIE['login_session_token']);
            setcookie('login_session_token', null, -1, '/'); 
            return response()->json([ 'error’ => ‘An error while decoding token.', ], 403); 
        }
    }
    protected function phoneFormat($phone_number) {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $phone_number_prototype = $phoneUtil->parse($phone_number, "TH");  
        } catch (\libphonenumber\NumberParseException $e) {
            
        }
        if( $phone_number_prototype ) {
            $phone_number = $phoneUtil->format($phone_number_prototype, \libphonenumber\PhoneNumberFormat::NATIONAL); 
        }
        $phone_number = str_replace(" ", "-", $phone_number);
        return $phone_number ;
    }
    protected function sendEmail( $params ) {  
        try {
            $api_key = env('MAILGUN_KEY'); 
            $mg = Mailgun::create( $api_key );
            $domain = env('MAILGUN_DOMAIN');
            $result = $mg->messages()->send(
                $domain, 
                array(
                    'from'    => "{$params['from_name']} <{$params['from']}>",
                    'to'      => "{$params['to_name']} <{$params['to']}>", 
                    'subject' => $params['title'],
                    'html'    => $params['body']
                )  
            ); 
        } catch(\Mailgun\Exception $e) {
            dd($e);
            $result = false; 
        } 
        return $result;
    }
    function sendVerifyEmail($email_params) {
        $cssToInlineStyles = new CssToInlineStyles();
        $verify_url = url("/verify/".$email_params['verify_key']);
        $html = file_get_contents( base_path('resources/mail/email_verify.html') );
        $css = file_get_contents( base_path('resources/mail/template.css') );
        $html = str_replace("{[email-verify-name]}", $email_params['to_name'], $html);
        $html = str_replace("{[email-verify-url]}", $verify_url, $html);
        $full_html = $cssToInlineStyles->convert(
            $html,
            $css
        );
        $email_params['from_name'] = "e-Recruitment System";
        $email_params['from'] = "no-reply@e-recruit.me";
        $email_params['title'] = "ยืนยันอีเมล e-Recruitment System";
        $email_params['body'] = $full_html;
        $this->sendEmail($email_params);
    }
    function sendApplicationFormNotifyEmail($email_params) {
        $cssToInlineStyles = new CssToInlineStyles(); 
        $html = file_get_contents( base_path('resources/mail/email_notify.html') );
        $css = file_get_contents( base_path('resources/mail/template.css') );
        $html = str_replace("{[email-notify-name]}", $email_params['to_name'], $html);
        $html = str_replace("{[email-notify-position]}", $email_params['position'], $html);
        $html = str_replace("{[email-notify-status]}", $email_params['status_text'], $html);
        $full_html = $cssToInlineStyles->convert(
            $html,
            $css
        );
        $email_params['from_name'] = "e-Recruitment System";
        $email_params['from'] = "no-reply@e-recruit.me";
        $email_params['title'] = "แจ้งเตือนสถานะการสมัครงานจากระบบ e-Recruitment System";
        $email_params['body'] = $full_html;
        $this->sendEmail($email_params);
    }
}
