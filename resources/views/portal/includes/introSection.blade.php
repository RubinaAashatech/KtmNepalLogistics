  <!-- For Introduction of KTM Logistics -->

  <section class="intro_section" id="intro_section">
      <div class="container">
          <div class="row">
              <div class="col-md-9 row ktm_intro">
                  <p class="ktm_intro_title">
                      Welcome to {{ $sitesetting->company_name }}
                  </p>
                  <div class="col-md-7 ktm_intro_image">
                      <img src="{{ url('uploads/sitesetting/' . $sitesetting->introduction_image) }}">
                  </div>

                  <div class="col-md-5 ktm_intro_text">
                      <p>{{ $sitesetting->introduction_text ?? 'null' }}</p>
                  </div>

              </div>

              <div class="col-md-3">
                  <form class="quick_contact form-inline row" method="POST" action="{{ route('request_contact') }}">
                      @csrf
                      <p class="quick_contact_title">
                          Quick Contact
                      </p>
                      <div class="col-md-4 mb-2">
                          <label for="Name" class="form-label">Name</label>
                      </div>
                      <div class="col-md-8 mb-2">
                          <input type="text" name="name" class="form-control" id="name" required>
                      </div>

                      <div class="col-md-4 mb-2">
                          <label for="Email" class="form-label">Email</label>
                      </div>
                      <div class="col-md-8 mb-2">
                          <input type="email" name="email" class="form-control" id="email" required>
                      </div>

                      <div class="col-md-4 mb-2">
                          <label for="Phone" class="form-label">Phone</label>
                      </div>
                      <div class="col-md-8 mb-2">
                          <input type="phone" name="phone" class="form-control" id="phone" required>
                      </div>

                      <div class="col-md-4 mb-2">
                          <label for="message" class="form-label">Message</label>
                      </div>
                      <div class="col-md-8 mb-2">
                          <textarea name="message" class="quick_contact_texarea" required></textarea>
                      </div>

                      <button type="submit" class="btn btn-quick_contact mb-2">Submit</button>

                      @if (Session::has('successMessage'))
                          <strong style="color:green">{{ Session::get('successMessage') }}</strong>
                      @endif
                      @if (Session::has('errorMessage'))
                          <strong style="color:red">{{ Session::get('errorMessage') }}</strong>
                      @endif

                  </form>
              </div>
          </div>
      </div>
  </section>
