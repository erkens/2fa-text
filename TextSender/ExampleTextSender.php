<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\TextSender;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;
use Symfony\Component\HttpClient\HttpClient;

class ExampleTextSender implements AuthCodeTextInterface
{
    private string $format;

    public function sendAuthCode(TwoFactorTextInterface $user, ?string $code = null): void
    {
        // this is just an example, as you can see, this would always generate an error because the host "text-message-api" is invalid
        HttpClient::create()->request(
            'POST',
            'https://text-message-api/send-sms',
            [
                'body' => [
                    'recipient' => $user->getTextAuthRecipient(),
                    'text' => sprintf($this->getMessageFormat(), $code ?? $user->getTextAuthCode()),
                ]
            ]
        );
    }

    public function setMessageFormat(string $format): void
    {
        $this->format = $format;
    }

    public function getMessageFormat(): string
    {
        return $this->format;
    }
}
