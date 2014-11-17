<?php

/**
 * JPhpMailer class file.
 *
 * @version alpha 2 (2010-6-3 16:42)
 * @author jerry2801 <jerry2801@gmail.com>
 * @required PHPMailer v5.1
 *
 * A typical usage of JPhpMailer is as follows:
 * <pre>
 * Yii::import('ext.phpmailer.JPhpMailer');
 * $mail=new JPhpMailer;
 * $mail->IsSMTP();
 * $mail->Host='smpt.163.com';
 * $mail->SMTPAuth=true;
 * $mail->Username='yourname@yourdomain';
 * $mail->Password='yourpassword';
 * $mail->SetFrom('name@yourdomain.com','First Last');
 * $mail->Subject='PHPMailer Test Subject via smtp, basic with authentication';
 * $mail->AltBody='To view the message, please use an HTML compatible email viewer!';
 * $mail->MsgHTML('<h1>JUST A TEST!</h1>');
 * $mail->AddAddress('whoto@otherdomain.com','John Doe');
 * $mail->Send();
 * </pre>
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.phpmailer.php';

class AvantiPhpMailer extends PHPMailer {

    /**
     * Sets the From email address for the message.
     * @var string
     */
    public $From = 'ti-dev@between.com.br';

    /**
     * Sets the From name of the message.
     * @var string
     */
    public $FromName = 'Avanti';

    /**
     * Sets the SMTP hosts.  All hosts must be separated by a
     * semicolon.  You can also specify a different port
     * for each host by using this format: [hostname:port]
     * (e.g. "smtp1.example.com:25;smtp2.example.com").
     * Hosts will be tried in order.
     * @var string
     */
    public $Host = 'smtp.gmail.com';

    /**
     * Sets the default SMTP server port.
     * @var int
     */
    public $Port = 587;

    /**
     * Sets connection prefix.
     * Options are "", "ssl" or "tls"
     * @var string
     */
    public $SMTPSecure = 'tls';

    /**
     * Sets SMTP authentication. Utilizes the Username and Password variables.
     * @var bool
     */
    public $SMTPAuth = true;

    /**
     * Sets SMTP username.
     * @var string
     */
    public $Username = 'ti-dev@between.com.br';

    /**
     * Sets SMTP password.
     * @var string
     */
    public $Password = 'devBdoB@2013';

    /**
     * Sets the SMTP server timeout in seconds.
     * This function will not work with the win32 version.
     * @var int
     */
    public $Timeout = 10;

    /**
     * Sets SMTP class debugging on or off.
     * @var bool
     */
    public $SMTPDebug = false;

}
