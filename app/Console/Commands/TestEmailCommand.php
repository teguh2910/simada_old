<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Rfq;
use App\Mail\RfqEmail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {rfq_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality for RFQ system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rfqId = $this->argument('rfq_id');

        if ($rfqId) {
            // Test with specific RFQ
            $rfq = Rfq::find($rfqId);
            if (!$rfq) {
                $this->error("RFQ with ID {$rfqId} not found!");
                return 1;
            }

            $this->info("Testing email with RFQ: {$rfq->part_name}");
            $this->sendRfqEmail($rfq);
        } else {
            // Test with simple email
            $this->info("Testing basic email functionality...");
            $this->sendTestEmail();
        }

        return 0;
    }

    private function sendTestEmail()
    {
        try {
            Mail::raw('This is a test email from SIMADA RFQ System at ' . \Carbon\Carbon::now(), function($message) {
                $message->to('test@example.com')
                        ->subject('Test Email - SIMADA RFQ System');
            });

            $this->info('✅ Basic test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Basic email failed: ' . $e->getMessage());
        }
    }

    private function sendRfqEmail(Rfq $rfq)
    {
        try {
            Mail::to('test@example.com')->send(new RfqEmail($rfq));
            $this->info('✅ RFQ email sent successfully!');
        } catch (\Exception $e) {
            $this->error('❌ RFQ email failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
