<?php


class SendMail
{
    private $headers;

    private $email;
    private $subject;

    private $domainName;
    private $domainEmail;

    private $content;

    public function __construct()
    {
        return $this;
    }

    /**
     * @throws ApiException
     */
    private function validate()
    {
        if (!isset($this->email))
            throw new ApiException("Email not set!");

        if (!isset($this->subject))
            throw new ApiException("Subject not set!");

        if (!isset($this->content))
            throw new ApiException("Email content not set!");
    }

    /**
     * @throws ApiException
     */
    private function buildHeaders()
    {
        if (!isset($this->domainEmail))
            throw new ApiException("Domain email not set!");

        if (!isset($this->domainName))
            throw new ApiException("Domain name not set!");

        $this->headers = "MIME-Version: 1.0" . "\r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $this->headers .= "From: ". "{$this->domainName}" ."<". "{$this->domainEmail}" .">" . "\r\n";
    }

    /**
     * @throws ApiException
     */
    public function send()
    {
        $this->validate();
        $this->buildHeaders();

        if(mail($this->email, $this->subject, $this->content, $this->headers))
            Logger::logMsg("MAIL","Email successful");
        else
        {
            $errorMessage = error_get_last()['message'];
            Logger::logMsg("MAIL","Email NOT successful");
            throw new ApiException("Mail was not sent!{$errorMessage}",101);
        }
    }

    public function setEmail($email): SendMail
    {
        $this->email = $email;
        return $this;
    }

    public function setSubject($subject): SendMail
    {
        $this->subject = $subject;
        return $this;
    }

    public function setDomainName($domainName): SendMail
    {
        $this->domainName = $domainName;
        return $this;
    }

    public function setDomainEmail($domainEmail): SendMail
    {
        $this->domainEmail = $domainEmail;
        return $this;
    }

    public function setContent($content): SendMail
    {
        $this->content = $content;
        return $this;
    }
}