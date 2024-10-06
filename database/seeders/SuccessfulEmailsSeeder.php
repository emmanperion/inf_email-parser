<?php

namespace Database\Seeders;

use App\Models\SuccessfulEmail;
use Illuminate\Database\Seeder;

class SuccessfulEmailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuccessfulEmail::create([
            'affiliate_id' => 1001,
            'envelope' => json_encode([
                'to' => ['recipient@example.com'],
                'from' => 'sender@example.com'
            ]),
            'from' => 'sender@example.com',
            'subject' => 'Welcome to Our Service',
            'dkim' => 'pass',
            'SPF' => 'pass',
            'spam_score' => 0.1,
            'email' => "Return-Path: <sender@example.com>\r\nReceived: by 2002:a9d:58c:: with SMTP id n28csp12345iob;\r\n        Fri, 22 Sep 2024 08:15:12 -0700 (PDT)\r\nFrom: Sender <sender@example.com>\r\nTo: Recipient <recipient@example.com>\r\nSubject: Welcome to Our Service\r\nDate: Fri, 22 Sep 2024 08:15:11 -0700\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\nHello,\n\nThank you for signing up with us. We are thrilled to have you.\n\nBest,\nCustomer Service",
            'raw_text' => "",
            'sender_ip' => '192.168.1.1',
            'to' => json_encode(['recipient@example.com']),
            'timestamp' => 1695401711
        ]);
    }
}
