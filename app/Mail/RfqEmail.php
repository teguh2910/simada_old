<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Rfq;
use Storage;

class RfqEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $rfq;

    /**
     * Create a new message instance.
     */
    public function __construct(Rfq $rfq)
    {
        $this->rfq = $rfq;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        \Log::info('Building RFQ email', ['rfq_id' => $this->rfq->id]);

        $email = $this->subject('RFQ Request: ' . $this->rfq->part_name . ' (' . $this->rfq->part_number . ')')
                    ->view('emails.rfq_simple');

        \Log::info('RFQ email view set', ['view' => 'emails.rfq']);

        // Attach files if they exist
        if ($this->rfq->drawing_file && Storage::disk('public')->exists($this->rfq->drawing_file)) {
            $filePath = Storage::disk('public')->path($this->rfq->drawing_file);
            \Log::info('Attaching drawing file', ['file' => $filePath]);
            $email->attach($filePath);
        }

        if ($this->rfq->excel_term_file && Storage::disk('public')->exists($this->rfq->excel_term_file)) {
            $filePath = Storage::disk('public')->path($this->rfq->excel_term_file);
            \Log::info('Attaching excel file', ['file' => $filePath]);
            $email->attach($filePath);
        }

        if ($this->rfq->loading_capacity_file && Storage::disk('public')->exists($this->rfq->loading_capacity_file)) {
            $filePath = Storage::disk('public')->path($this->rfq->loading_capacity_file);
            \Log::info('Attaching capacity file', ['file' => $filePath]);
            $email->attach($filePath);
        }

        \Log::info('RFQ email build completed');
        return $email;
    }
}