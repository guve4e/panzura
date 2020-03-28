<?php
require_once (AUTHORIZATION_PATH . "/UnAuthorizedController.php");
require_once (COMMON_PATH . "/SendMail.php");

final class MailController extends UnAuthorizedController
{
    /**
     * __construct
     *
     * @access public
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * POST
     *
     * @throws Exception
     */
    public function post($id)
    {
        $info = $this->getJsonData();

        try {

            $text = "Hello From our test mail server.";
            $text .= "<br>Here is your content:<br>{$info['content']}";

            $subject = "Test email";

            $mail = new SendMail();

            $mail->setEmail($info['email'])
                ->setSubject($info['subject'])
                ->setDomainName($info['domain'])
                ->setDomainEmail("web-tech@web-tech.com")
                ->setContent($text)
                ->send();

            $result = "success";
        } catch (ApiException $e) {

            $result = "mail was not sent\n";
            $result .= "Exception: {$e->getMessage()}";
        }

        $this->send($result);
    }
}

