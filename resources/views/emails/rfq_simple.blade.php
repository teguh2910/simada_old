<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>RFQ Request</title>
</head>

<body>
    <h1>RFQ Request: {{ $rfq->part_name }}</h1>
    <p><strong>Part Number:</strong> {{ $rfq->part_number }}</p>
    <p><strong>Customer:</strong> {{ $rfq->customer }}</p>
    <p><strong>Product:</strong> {{ $rfq->produk }}</p>
    <p><strong>Quantity:</strong> {{ $rfq->std_qty }}</p>
    <p><strong>Due Date:</strong> {{ $rfq->due_date ? $rfq->due_date->format('Y-m-d') : 'N/A' }}</p>
    <p><strong>PIC:</strong> {{ $rfq->pic_name }}</p>

    @if ($rfq->note)
        <p><strong>Notes:</strong> {{ $rfq->note }}</p>
    @endif

    <h2>Attachments:</h2>
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
    </ul>

    <p>Please provide your quotation for this RFQ.</p>
</body>

</html>
