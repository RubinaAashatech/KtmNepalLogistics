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
        .modal-header .company-info {
            position: absolute;
            top: 0;
            left: 0;
            margin: 10px;
        }
        .barcode {
            position: absolute;
            top: 10px;
            right: 10px;
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
    <div class="container">
        <h1>Track Parcel</h1>
        
        <form id="track-form">
            @csrf
            <div class="form-group">
                <label for="tracking_number">Tracking Number:</label>
                <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Track</button>
        </form>

        <!-- Modal Structure -->
        <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex align-items-center">
                            <img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}" class="img-fluid me-2" alt="logo" style="max-height: 40px;">
                            <div>
                                <strong>{{ $sitesetting->company_name }}</strong><br>
                                {{ $sitesetting->location }}<br>
                                {{ $sitesetting->contact_number }}<br>
                                {{ $sitesetting->email }}
                            </div>
                        </div>
                        <img id="barcode" class="barcode img-fluid" alt="Barcode">
                        <div class="ms-auto d-flex align-items-center">
                            <button type="button" class="btn btn-secondary me-2 print-hide" id="print-btn">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body" id="tracking-result">
                        <!-- Tracking result will be inserted here -->
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
    </div>

    <script>
        document.getElementById('track-form').addEventListener('submit', function(event) {
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

        document.getElementById('print-btn').addEventListener('click', function() {
            const printWindow = window.open('', '', 'height=600,width=800');
            const companyInfo = `
                <div class="print-company-info">
                    <img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}" class="img-fluid" alt="logo" style="max-height: 60px;"><br>
                    <strong>{{ $sitesetting->company_name }}</strong><br>
                    {{ $sitesetting->location }}<br>
                    {{ $sitesetting->contact_number }}<br>
                    {{ $sitesetting->email }}
                </div>
            `;
            const trackingInfo = document.getElementById('tracking-result').innerHTML;
            
            printWindow.document.write('<html><head><title>Print Tracking Information</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />');
            printWindow.document.write('</head><body>');
            printWindow.document.write(companyInfo);
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
                                <td>${formatDate(update.updated_at) || ''}</td>
                                <td>${update.status || ''}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
    </script>
</body>
</html>
