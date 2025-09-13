<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function testEmail()
    {
        try {
            Mail::raw('This is a test email from SIMADA RFQ System', function($message) {
                $message->to('test@example.com')
                        ->subject('Test Email - SIMADA RFQ System');
            });

            return 'Test email sent successfully! Check your Mailtrap inbox.';
        } catch (\Exception $e) {
            return 'Email failed: ' . $e->getMessage();
        }
    }
}