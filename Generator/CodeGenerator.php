<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Generator;

use Erkens\Security\TwoFactorTextBundle\TextSender\AuthCodeTextInterface;
use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;
use Scheb\TwoFactorBundle\Model\PersisterInterface;

class CodeGenerator implements CodeGeneratorInterface
{
    /**
     * @var PersisterInterface
     */
    private $persister;

    /**
     * @var AuthCodeTextInterface
     */
    private $textSender;

    /**
     * @var int
     */
    private $digits;
    /**
     * @var string
     */
    private $text;

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
        $this->textSender->sendAuthCode($user, $this->text);
    }

    public function reSend(TwoFactorTextInterface $user): void
    {
        $this->textSender->sendAuthCode($user, $this->text);
    }

    protected function generateCode(int $min, int $max): int
    {
        return random_int($min, $max);
    }
}
