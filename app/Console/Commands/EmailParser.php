<?php

namespace App\Console\Commands;

use App\Services\ParseEmailService;
use Illuminate\Console\Command;
use App\Models\SuccessfulEmail;

class EmailParser extends Command
{
    private ParseEmailService $parseEmailService;

    /**
     * Constructor for injecting the ParseEmailService
     */
    public function __construct(ParseEmailService $parseEmailService)
    {
        parent::__construct();
        $this->parseEmailService = $parseEmailService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the raw email content to extract plain text.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Let's fetch unprocessed emails.
        $emails = SuccessfulEmail::where(function ($query) {
            $query->whereNull('raw_text')
                ->orWhere('raw_text', '');
        })->get();

        if ($emails->isEmpty()) {
            $this->info('No emails to parse.');
            return;
        }

        $this->info('Parsing emails...');

        foreach ($emails as $email) {
            $plainText = $this->parseEmailService->parseEmailContent($email->email);

            $email->raw_text = $plainText;
            $email->save();
        }

        $this->info('Email parsing completed.');
    }
}
