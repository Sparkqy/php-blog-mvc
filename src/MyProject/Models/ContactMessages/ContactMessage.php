<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11/11/2018
 * Time: 3:37 AM
 */

namespace MyProject\Models\ContactMessages;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;

class ContactMessage extends ActiveRecordEntity
{
    protected $senderName;
    protected $text;
    protected $date;

    public function getSenderName(): string
    {
        return (string) $this->senderName;
    }
    public function getText(): string
    {
        return (string) $this->text;
    }
    public function getDate(): string
    {
        return (string) $this->date;
    }

    public function setSenderName(string $senderName): void
    {
        $this->senderName = ucfirst($senderName);
    }
    public function setText(string $text): void
    {
        $this->text = trim(htmlspecialchars(ucfirst($text)));
    }

    public static function getTableName(): string
    {
        return 'contact_messages';
    }

    public static function sendMessage(array $fields): void
    {
        if (empty($fields['cName']))
        {
            throw new InvalidArgumentException('Empty name field.');
        }

        if (empty($fields['cMessage']))
        {
            throw new InvalidArgumentException('Empty message field.');
        }

        $message = new ContactMessage();

        $message->setSenderName($fields['cName']);
        $message->setText($fields['cMessage']);

        $message->save();
    }
}