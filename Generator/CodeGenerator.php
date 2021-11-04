<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Generator;

use Erkens\Security\TwoFactorTextBundle\TextSender\AuthCodeTextInterface;
use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;
use Scheb\TwoFactorBundle\Model\PersisterInterface;

class CodeGenerator implements CodeGeneratorInterface
{
    private PersisterInterface $persister;
    private AuthCodeTextInterface $textSender;
    private int $digits;
    private string $text;

    public function __construct(
        PersisterInterface $persister,
        AuthCodeTextInterface $textSender,
        int $digits,
        string $text
    ) {
        $this->persister = $persister;
        $this->textSender = $textSender;
        $this->digits = $digits;
        $this->text = $text;
    }

    public function generateAndSend(TwoFactorTextInterface $user): void
    {
        $code = $this->generateCode();
        $user->setTextAuthCode($code);
        $this->persister->persist($user);
        $this->send($user);
    }

    public function returnAndSendWithMessage(TwoFactorTextInterface $user, string $text): string
    {
        $code = $this->generateCode();
        $this->textSender->setMessageFormat($text);
        $this->textSender->sendAuthCode($user, $code);
        return $text;
    }

    public function reSend(TwoFactorTextInterface $user): void
    {
        $this->send($user);
    }

    protected function send(TwoFactorTextInterface $user): void
    {
        $this->textSender->setMessageFormat($this->text);
        $this->textSender->sendAuthCode($user, $user->getTextAuthCode());
    }

    protected function generateCode(): string
    {
        $min = 10 ** ($this->digits - 1);
        $max = 10 ** $this->digits - 1;
        return (string) random_int($min, $max);
    }
}
