<?php

require 'C:/Users/HP/Downloads/SDPPROJECT/vendor/autoload.php'; // Include Composer autoload file
// use HTTP_Request2;

interface NotificationSender {
    public function send(string $recipient, string $message): bool;
}

class EmailNotificationAdapter implements NotificationSender {
    private $emailService;

    public function __construct($emailService) {
        $this->emailService = $emailService;
    }

    public function send(string $recipient, string $message): bool {
        return $this->emailService->sendEmail($recipient, "Notification", $message);
    }
}
class SmsNotificationAdapter implements NotificationSender {
    private $smsService;

    public function __construct($smsService) {
        $this->smsService = $smsService;
    }

    public function send(string $message, string $recipient): bool {
        return $this->smsService->sendSms($message, $recipient);
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class EmailService {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'faridaelhussieny@gmail.com';
        $this->mailer->Password = 'pubsdsgaoarvvzsh';  // Use an App Password here
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use SMTPS (SSL)
        $this->mailer->Port = 587;  // Port for SMTPS
        $this->mailer->setFrom('faridaelhussieny@gmail.com', 'Volunteer Management System');
        $this->mailer->SMTPDebug = 2; // Enable detailed debug output
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->send();
            echo "Message has been sent";
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
            return false;
        } finally {
            $this->mailer->clearAddresses();
        }
        return true;
    }
}


use Twilio\Rest\Client;


class SMSNotificationService {

    private $apiKey;
    private $baseUrl;
    private $fromPhone;

    // Constructor to initialize the Infobip credentials
    public function __construct() {
        $this->apiKey = "d1899e189f53d6960c2832f9252b7f18-67d045d1-13b2-44a3-a3b4-a1cb3ec1df59"; // Replace with your Infobip API key
        $this->baseUrl = "https://3811gn.api.infobip.com"; // Replace with your Infobip Base URL
        $this->fromPhone = "447491163443"; // Infobip allows alphanumeric sender IDs
    }

    // Method to send SMS notifications
    public function sendSms($msg, $userPhone) {
        echo "Sending SMS to {$userPhone}";

        // Prepare the API endpoint
        $url = "{$this->baseUrl}/sms/2/text/advanced";

        // Create a new HTTP_Request2 instance
        $request = new HTTP_Request2();
        $request->setUrl($url);
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig([
            'follow_redirects' => true,
        ]);
        $request->setHeader([
            'Authorization' => "App {$this->apiKey}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);

        // Prepare the payload
        $payload = [
            "messages" => [
                [
                    "from" => $this->fromPhone,
                    "destinations" => [
                        ["to" => $userPhone],
                    ],
                    "text" => $msg,
                ],
            ],
        ];

        $request->setBody(json_encode($payload));

        // Send the request and handle the response
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                echo "SMS sent successfully to {$userPhone}: " . $response->getBody();
                return true;
            } else {
                echo "Unexpected HTTP status: " . $response->getStatus() . " " . $response->getReasonPhrase();
                return false;
            }
        } catch (HTTP_Request2_Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}





?>