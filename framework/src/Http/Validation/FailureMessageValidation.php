<?php
namespace Frmk\Http\Validation;

class FailureMessageValidation
{
    public static array $failuresMsgs = [];

    public static function addMsg(array $FailureMsg)
    {
        self::$failuresMsgs[] = $FailureMsg;
    }

    public static function getMsgs(): array
    {
        return self::$failuresMsgs;
    }
}
