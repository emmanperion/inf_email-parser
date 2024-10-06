<?php

namespace App\Services;

use PhpMimeMailParser\Parser;

class ParseEmailService
{
    /**
     * Parse the raw email content and return plain text.
     *
     * @param string $rawEmail
     * @return string
     */
    public function parseEmailContent(string $rawEmail): string
    {
        $parser = new Parser();
        $parser->setText($rawEmail);

        $plainText = $parser->getMessageBody('text');

        return preg_replace('/[^\PC\n]/u', '', $plainText);
    }
}
