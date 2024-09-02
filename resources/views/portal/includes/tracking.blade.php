<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
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
                    <h5 class="modal-title" id="trackingModalLabel">Tracking Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
      return `
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Tracking Number</th>
                      <th>Carrier</th>
                      <th>Dispatched Date</th>
                      <th>Weight</th>
                      <th>Estimated Delivery</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>${parcel.tracking_number || ''}</td>
                      <td>${parcel.carrier || ''}</td>
                      <td>${formatDate(parcel.sending_date) || ''}</td>
                      <td>${parcel.weight || ''}</td>
                      <td>${formatDate(parcel.estimated_delivery_date) || ''}</td>
                  </tr>
              </tbody>
          </table>
      `;
  }

  function formatReceiverTable(receiver) {
      return `
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Address</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>${receiver.fullname || ''}</td>
                      <td>
                        ${receiver.street_address || ''}<br>
                        ${receiver.city || ''}, ${receiver.state || ''}<br>
                        ${receiver.country || ''}, ${receiver.postal_code || ''}
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
                          <td>${formatDate(update.created_at)}</td>
                          <td>${update.status || ''}</td>
                      </tr>
                  `).join('')}
              </tbody>
          </table>
      `;
  }

  function formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString(); // Format the date to "MM/DD/YYYY" or similar format depending on locale
  }
</script>
