<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\TextSender;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;
use Symfony\Component\HttpClient\HttpClient;

class ExampleTextSender implements AuthCodeTextInterface
{
    public function sendAuthCode(TwoFactorTextInterface $user, string $format): void
    {
        // this is just an example, as you can see, this would always generate an error because the host "text-message-api" is invalid
        HttpClient::create()->request(
            'POST',
            'https://text-message-api/send-sms',
            [
                'body' => [
                    'recipient' => $user->getTextAuthRecipient(),
                    'text' => sprintf($format, $user->getTextAuthCode()),
                ]
            ]
        );
    }
}
