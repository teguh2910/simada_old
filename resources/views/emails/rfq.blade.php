<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>RFQ Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
        }

        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid #e9ecef;
        }

        .section h3 {
            margin-top: 0;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .field {
            margin-bottom: 10px;
        }

        .field-label {
            font-weight: bold;
            color: #495057;
        }

        .field-value {
            color: #6c757d;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
            color: #6c757d;
        }

        .urgent {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>RFQ Request</h1>
        <p>Request for Quotation - {{ $rfq->part_name }}</p>
    </div>

    <div class="content">
        <div class="urgent">
            <strong>⚠️ Action Required:</strong> Please review this RFQ and provide your quotation within the specified
            timeline.
        </div>

        <div class="section">
            <h3>📋 RFQ Details</h3>
            <div class="field">
                <span class="field-label">RFQ ID:</span>
                <span class="field-value">#{{ $rfq->id }}</span>
            </div>
            <div class="field">
                <span class="field-label">Part Number:</span>
                <span class="field-value">{{ $rfq->part_number ?? 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Part Name:</span>
                <span class="field-value">{{ $rfq->part_name ?? 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Customer:</span>
                <span class="field-value">{{ $rfq->customer ?? 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Product:</span>
                <span class="field-value">{{ $rfq->produk ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="section">
            <h3>📊 Quantity & Requirements</h3>
            <div class="field">
                <span class="field-label">Standard Quantity:</span>
                <span class="field-value">{{ isset($rfq->std_qty) ? number_format($rfq->std_qty) : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Monthly Quantity:</span>
                <span class="field-value">{{ isset($rfq->qty_month) ? number_format($rfq->qty_month) : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">PIC:</span>
                <span class="field-value">{{ $rfq->pic_name ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="section">
            <h3>📅 Important Dates</h3>
            <div class="field">
                <span class="field-label">Drawing Time:</span>
                <span
                    class="field-value">{{ isset($rfq->drawing_time) && $rfq->drawing_time ? $rfq->drawing_time->format('Y-m-d') : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">OTS Target:</span>
                <span
                    class="field-value">{{ isset($rfq->OTS_Target) && $rfq->OTS_Target ? $rfq->OTS_Target->format('Y-m-d') : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">OTOP Target:</span>
                <span
                    class="field-value">{{ isset($rfq->OTOP_target) && $rfq->OTOP_target ? $rfq->OTOP_target->format('Y-m-d') : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">SOP:</span>
                <span
                    class="field-value">{{ isset($rfq->SOP) && $rfq->SOP ? $rfq->SOP->format('Y-m-d') : 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Due Date:</span>
                <span
                    class="field-value">{{ isset($rfq->due_date) && $rfq->due_date ? $rfq->due_date->format('Y-m-d') : 'N/A' }}</span>
            </div>
        </div>

        <div class="section">
            <h3>🏢 Supplier Information</h3>
            <div class="field">
                <span class="field-label">Target Suppliers:</span>
                <span class="field-value">{{ $rfq->suppliers_formatted ?? 'N/A' }}</span>
            </div>
        </div>

        @if ($rfq->note)
            <div class="section">
                <h3>📝 Additional Notes</h3>
                <p>{{ $rfq->note }}</p>
            </div>
        @endif

        <div class="section">
            <h3>📎 Attachments</h3>
            <p>Please find the following attachments with this email:</p>
            <ul>
                @if ($rfq->drawing_file)
                    <li>Drawing File: {{ basename($rfq->drawing_file) }}</li>
                @endif
                @if ($rfq->excel_term_file)
                    <li>Excel Term File: {{ basename($rfq->excel_term_file) }}</li>
                @endif
                @if ($rfq->loading_capacity_file)
                    <li>Loading Capacity File: {{ basename($rfq->loading_capacity_file) }}</li>
                @endif
                @if (!$rfq->drawing_file && !$rfq->excel_term_file && !$rfq->loading_capacity_file)
                    <li>No attachments included</li>
                @endif
            </ul>
        </div>

        <div class="section">
            <h3>📧 Response Instructions</h3>
            <p>Please provide your quotation including:</p>
            <ul>
                <li>Unit price per part</li>
                <li>Minimum order quantity</li>
                <li>Lead time</li>
                <li>Payment terms</li>
                <li>Any additional requirements or conditions</li>
            </ul>
            <p><strong>Response Deadline:</strong>
                {{ isset($rfq->due_date) && $rfq->due_date ? $rfq->due_date->format('F j, Y') : 'As soon as possible' }}
            </p>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated message from SIMADA RFQ System</p>
        <p>Please do not reply to this email. Contact the PIC directly for any questions.</p>
        <p>&copy; {{ date('Y') }} SIMADA - Request for Quotation System</p>
    </div>
</body>

</html>
