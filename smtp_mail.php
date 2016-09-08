<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/2
 * Time: 14:20
 */
class mail
{
    private $host;
    private $port;
    private $user;
    private $pas;
    private $debug = true;
    private $sock;
    private $mail_format;

    public function __construct($host, $port, $user, $pas, $debug = 1)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = base64_encode($user);//mail require crypt name and pas use base64_encode
        $this->pas = base64_encode($pas);
        $this->debug;

        $this->sock = fsockopen($this->host, $this->port, $errno, $errstr, 10);
        if (!$this->sock) {
            exit("Error numer: $errno,Error msg: $errstr");
        }

        $respons = fgets($this->sock);
        if (strstr($respons, '200') === false) {
            exit('server error:$respose');
        }
    }

    private function show_debug($msg)
    {
        if ($this->debug) {
            echo "<p>Debug:$msg</p><br/>";
        }
    }

    private function do_commend($cmd, $ret)
    {
        fwrite($this->sock, $cmd);
        $response = fgets($this->sock);
        if (strstr($response, "$ret") === false) {
            $this->show_debug($response);
            return false;
        }
        return true;
    }

    private function is_email($email)
    {
        $pattern = "/^[^_][\w]*@[\w.]+[\w]*[^_]$/";
        if (preg_match($pattern, $email, $matches)) {
            return true;
        } else {
            return false;
        }
    }

    public function send_mail($from, $to, $subject, $body)
    {
        if (!$this->is_email($from) or !$this->is_email($to)) {
            $this->show_debug("Please enter valid from/to email");
            return false;
        }

        if (empty($subject) or empty($body)) {
            $this->show_debug("Please enter subject / body");
            return false;
        }

        $detail = "From:" . $from . "\r\n";
        $detail .= "To:" . $to . "\r\n";
        $detail .= "Subject:" . $subject . "\r\n";

        if ($this->mail_format == 1) {
            $detail .= "Content-Type:text/html;\r\n";
        } else {
            $detail .= "Content-Type:text/plain;\r\n";
        }

        $detail .= "charset = gbk2312\r\n\r\n";
        $detail .= $body;

        $this->do_commend("HELO smtp.qq.com\r\n", 250);
        $this->do_commend("AUTH LOGIN\r\n", 334);
        $this->do_commend($this->user, 334);
        $this->do_commend($this->pas, 235);
        $this->do_commend("MAIL FROM:<" . $from . ">\r\n", 250);
        $this->do_commend("REPT TO:<" . $to . ">\r\n", 250);
        $this->do_commend("DATA\r\n", 354);
        $this->do_commend($detail . "\r\n", 250);
        $this->do_commend("QUIT\r\n", 221);
        return true;
    }
}

$host = "smtp.qq.com";
$port = 25;
$user = '943656057@qq.com';
$pas = 'niujingmf123';

$from = '943656057@qq.com';
$to = '2217378332@qq.com';
$subject = "test mail";
$content = "just test";

$mail = new mail($host, $port, $user, $pas);
$mail->send_mail($from, $to, $subject, $content);