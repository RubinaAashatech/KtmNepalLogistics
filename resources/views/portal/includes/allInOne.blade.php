                <!-- For Tabs -->
                <section class="all_in_one"> 
                            
                  <div class="tabs">
                      <input type="radio" name="tab" id="tab1" checked="checked">
                      <label for="tab1">Global Network</label>
                      <input type="radio" name="tab" id="tab2">
                      <label for="tab2">Cargo Airlines</label>
                      <input type="radio" name="tab" id="tab3">
                      <label for="tab3">Gallery</label>
                      <input type="radio" name="tab" id="tab4">
                      <label for="tab4">Upcoming Events</label>

                      <div class="tab-content-wrapper">
                          <div id="tab-content-1" class="tab-content">
                              <iframe class="google_map"
                                  src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d220.8191341125652!2d85.34241590352012!3d27.683114024043853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1628585136581!5m2!1sen!2snp"
                                  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                          </div>
                          <div id="tab-content-2" class="tab-content">

                              <p>{{ $sitesetting->introduction_text ?? '' }}</p>
                          </div>
                          <div id="tab-content-3" class="tab-content">
                              <div class="row">
                              @foreach ($images as $image)
                              <div class="col-md-4">
                                  <img class="tab_gallery" src="{{ url('uploads/gallery/' . $image->image) }}">
                              </div>
                              @endforeach
                              </div>

                          </div>
                          <div id="tab-content-4" class="tab-content">
                              @foreach ($events as $event)
                                  <ul class="events_text">
                                      
                                    <li><a href="{{ route('render_posts', $event->id) }}">{{ $event->title }}</a></li>
                                </ul>
                              @endforeach

                          </div>

                      </div>
                  </div>
             

             

     
  </section>
