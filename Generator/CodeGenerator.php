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
        $min = 10 ** ($this->digits - 1);
        $max = 10 ** $this->digits - 1;
        $code = $this->generateCode($min, $max);
        $user->setTextAuthCode((string)$code);
        $this->persister->persist($user);
        $this->send($user);
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

    protected function generateCode(int $min, int $max): int
    {
        return random_int($min, $max);
    }
}
