<?php
require_once (AUTHORIZATION_PATH . "/UnAuthorizedController.php");
require_once (COMMON_PATH . "/SendMail.php");
require_once (COMMON_PATH . "/EmailContentBuilder.php");
require_once (COMMON_PATH . "/CommonHtml.php");
require_once (THIRD_PARTY . "/shipping/lib/Shipping.php");
require_once (THIRD_PARTY . "/shipping/lib/UpsShipping.php");
require_once (LIBRARY_PATH . "/phphttp/RestCall.php");

final class ShippingMail extends UnAuthorizedController
{
    use CommonHtml;

    /**
     * @param array $dateTime
     * @return string representing the date
     * @throws Exception
     */
    private function sanitizeJavaDateTime(array $dateTime)
    {
        if (count($dateTime) < 3)
            throw new ApiException ("Malformed date in sanitizeJavaDateTime()!");

        $dateString = $dateTime[1] . "/" . $dateTime[2] . "/" . $dateTime[0];

        $timestamp = strtotime($dateString);

        return date("F j, Y", $timestamp);
    }

    /**
     * @param string $trackingNumber
     * @return string
     */
    private function getTrackingInformation(string $trackingNumber)
    {
        try {

            $credentials = [
                "username" => "adelpetrova@avacosmetika.com",
                "password" => "Ro6ko@ava123",
                "license" => "DD78947623B39D30"
            ];

            $shipping = new Shipping("UPS", new RestCall("Curl", new FileManager()), $credentials);
            return $shipping->createTackingPackageLink($trackingNumber);

        } catch (Exception $e) {
            Logger::logException($e->getMessage());
            return null;
        }
    }

    /**
     * POST
     * @throws Exception
     */
    public function post($id)
    {
        $order = $this->getJsonData();

        $trackingNumbers = $order['trackingInfoList'];

        $trackingNumberString = "Number";

        if (count($trackingNumbers) == 0)
            throw new ApiException("Malformed Order, no package (tracking) info");

        if (count($trackingNumbers) > 1)
            $trackingNumberString = "Numbers";

        $text = "Your order <strong># {$order['orderNumber']}</strong> has shipped with UPS Tracking {$trackingNumberString}: <br> ";

        foreach ($trackingNumbers as $trackingNumber)
        {
            $date = $this->sanitizeJavaDateTime($trackingNumber['deliveryDate']);

            $trackingNumber = $trackingNumber['trackingNumber'];

            $text .= "<strong>{$trackingNumber}-";
            $text .= "Your package is estimated to arrive by <span style='color: #008a00'> {$date}.</span><br>";

            $link = $this->getTrackingInformation($trackingNumber);

            if (!is_null($link))
                $text .= "<br>You can track your package <a href='$link'>here</a>.<br>";
        }

        $html = $this->makeHtml($order, $text);
        $emailBuilder = new EmailContentBuilder($text, $html);
        $content = $emailBuilder->makeHtmlContent();

        $subject = "Your AVA Cosmetika CSerum Order #{$order['orderNumber']} has shipped";

        $mail = new MailController();

        $mail->setEmail($order['shippingInfo']['email'])
            ->setSubject($subject)
            ->setDomainName("AVA Cosmetika")
            ->setDomainEmail("order@avacosmetika.com")
            ->setContent($content)
            ->send();

        $result = "success";

        $this->send($result);
    }

    public function makeHtml($order, $text)
    {
        return "
            {$this->makeHeading($order['shippingInfo']['name'], $text)}

            {$this->makeShippingInfo($order)}

            {$this->makeProductsTable($order['shoppingCart']['products'])}

            {$this->makeSummary($order)}

            <br>";
    }
}

