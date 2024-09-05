<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Parcel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }
        .tracking-section {
            background-color: #2c3e50;
            padding: 30px 0;
            width: 100%;
        }
        .tracking-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .tracking-form {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .tracking-label {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-right: 15px;
            white-space: nowrap;
        }
        .tracking-input {
            flex-grow: 1;
            margin-right: 10px;
            padding: 10px 15px;
            font-size: 1rem;
            border: none;
            border-radius: 25px;
            background-color: #f0f2f5;
        }
        .tracking-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 25px;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .tracking-button:hover {
            background-color: #2980b9;
        }
        .tracking-icon {
            color: #3498db;
            margin-right: 15px;
            font-size: 1.5rem;
        }
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            background-color: #3498db;
            color: white;
            border-bottom: none;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1.5rem;
        }
        .modal-body {
            padding: 2rem;
        }
        .modal-footer {
            background-color: #f8f9fa;
            border-top: none;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 1rem;
        }
        .company-info {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }
        .company-info img {
            max-height: 50px;
            margin-right: 15px;
        }
        .tracking-details h3 {
            color: #2c3e50;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .table {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #3498db;
            color: white;
            border: none;
        }
        .table-bordered td, .table-bordered th {
            border-color: #e9ecef;
        }
        .btn-close {
            color: white;
            opacity: 1;
            padding: 0.5rem;
            margin: -0.5rem -0.5rem -0.5rem auto;
        }
        .btn-close:hover {
            opacity: 0.8;
        }
        #barcode {
            max-width: 200px;
            margin-bottom: 10px;
        }
        #tracking-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
        }
        .btn-print {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-print:hover {
            background-color: #27ae60;
        }
        @media print {
            .print-company-info {
                display: block;
                text-align: center;
                margin-bottom: 20px;
            }
            .print-hide {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="tracking-section">
        <div class="tracking-container">
            <form id="track-form" class="tracking-form">
                @csrf
                <i class="fas fa-search tracking-icon"></i>
                <label for="tracking_number" class="tracking-label">Track Your Shipment</label>
                <input type="text" class="tracking-input" id="tracking_number" name="tracking_number" placeholder="Enter Tracking Number" required>
                <button type="submit" class="tracking-button">Track Now</button>
            </form>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel">Tracking Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="company-info mb-4">
                        <img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}" alt="logo">
                        <div>
                            <h5 class="mb-1">{{ $sitesetting->company_name }}</h5>
                            <small>{{ $sitesetting->location }} | {{ $sitesetting->contact_number }} | {{ $sitesetting->email }}</small>
                        </div>
                        <button type="button" class="btn-print ms-auto" id="print-btn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>
                    <div class="text-center mb-4">
                        <img id="barcode" class="img-fluid" alt="Barcode">
                        <div id="tracking-number"></div>
                    </div>
                    <div id="tracking-result" class="tracking-details">
                        <!-- Tracking result will be inserted here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="error-message" class="alert alert-danger mt-4 d-none">
        <!-- Error message will be inserted here -->
    </div>

    <script>
        document.getElementById('track-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const resultDiv = document.getElementById('tracking-result');
            const errorDiv = document.getElementById('error-message');

            fetch('{{ route('track-parcel') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data);

                    const trackingModal = new bootstrap.Modal(document.getElementById('trackingModal'));

                    if (data.error) {
                        resultDiv.innerHTML = '';
                        errorDiv.textContent = data.error;
                        errorDiv.classList.remove('d-none');
                        trackingModal.show();
                    } else {
                        errorDiv.classList.add('d-none');
                        resultDiv.innerHTML = formatTrackingData(data.trackingInfo);
                        trackingModal.show();
                        if (data.trackingInfo.parcel.barcode_image) {
                            document.getElementById('barcode').src = `data:image/png;base64,${data.trackingInfo.parcel.barcode_image}`;
                            document.getElementById('tracking-number').textContent = data.trackingInfo.parcel.tracking_number || '';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultDiv.innerHTML = '';
                    errorDiv.textContent = 'An error occurred while tracking the parcel.';
                    errorDiv.classList.remove('d-none');
                    const trackingModal = new bootstrap.Modal(document.getElementById('trackingModal'));
                    trackingModal.show();
                });

        });

        document.getElementById('print-btn').addEventListener('click', function () {
            const printWindow = window.open('', '', 'height=600,width=800');
            
            const companyInfo = `
                <div class="print-company-info text-center">
                    <img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}" class="img-fluid"
                        alt="logo" style="max-height: 60px;"><br>
                    <strong>{{ $sitesetting->company_name }}</strong><br>
                    {{ $sitesetting->location }}<br>
                    {{ $sitesetting->contact_number }}<br>
                    {{ $sitesetting->email }}
                </div>
            `;
            
            const barcodeImage = document.getElementById('barcode').outerHTML;
            const trackingNumber = document.getElementById('tracking-number').textContent;
            const trackingInfo = document.getElementById('tracking-result').innerHTML;

            printWindow.document.write('<html><head><title>Print Tracking Information</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />');
            printWindow.document.write('</head><body>');
            printWindow.document.write(companyInfo);
            printWindow.document.write('<div class="text-center">' + barcodeImage + '</div>');
            printWindow.document.write('<div class="text-center"><strong>' + trackingNumber + '</strong></div>');
            printWindow.document.write(trackingInfo);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        });

        function formatTrackingData(data) {
            let html = '';
            if (typeof data === 'object' && data !== null) {
                if (data.parcel) {
                    html += '<h3>Parcel Information</h3>';
                    html += formatParcelTable(data.parcel);
                }
                if (data.receiver) {
                    html += '<h3>Receiver Information</h3>';
                    html += formatReceiverTable(data.receiver);
                }
                if (data.tracking_updates) {
                    html += '<h3>Tracking Updates</h3>';
                    html += formatTrackingUpdatesTable(data.tracking_updates);
                }
            }
            return html;
        }

        function formatParcelTable(parcel) {
            let forwardingNumberRow = '';

            console.log('Parcel Data:', parcel);

            if (parcel.forwarder_number && parcel.forwarder_number.trim() !== '') {
                forwardingNumberRow = `
                    <tr>
                        <th>Forwarding Number</th>
                        <td>${parcel.forwarder_number}</td>
                    </tr>
                `;
            } else {
                console.log('Forwarding Number is not present');
            }

            return `
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Tracking Number</th>
                            <td>${parcel.tracking_number || ''}</td>
                        </tr>
                        <tr>
                            <th>Carrier</th>
                            <td>${parcel.carrier || ''}</td>
                        </tr>
                        <tr>
                            <th>Dispatched Date</th>
                            <td>${formatDate(parcel.sending_date) || ''}</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>${parcel.weight || ''}</td>
                        </tr>
                        <tr>
                            <th>Estimated Delivery</th>
                            <td>${formatDate(parcel.estimated_delivery_date) || ''}</td>
                        </tr>
                        ${forwardingNumberRow}
                    </tbody>
                </table>
            `;
        }

        function formatReceiverTable(receiver) {
            return `
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>${receiver.fullname || ''}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td style="white-space: nowrap;">
                                ${receiver.street_address || ''},
                                ${receiver.city || ''},
                                ${receiver.state || ''},
                                ${receiver.country || ''},
                                ${receiver.postal_code || ''}
                            </td>
                        </tr>
                    </tbody>
                </table>
            `;
        }

        function formatTrackingUpdatesTable(trackingUpdates) {
            return `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${trackingUpdates.map(update => `
                            <tr>
                                <td>${formatDate(update.created_at) || ''}</td>
                                <td>${update.status || ''}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        }

        function formatDate(dateString) {
            if (!dateString) {
                return '';
            }
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString(undefined, options);
        }
    </script>
</body>

</html>
