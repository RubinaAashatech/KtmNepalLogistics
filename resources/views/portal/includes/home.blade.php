
<div class="container">
  <!-- For Cards and Stuffs -->
  <section class="delivery">
      
          <div class="row">
              @foreach ($services as $service)
                  <div class="col-md-3">
                      <div class="card">
                          <img src="{{ url('uploads/service/' . $service->image ?? '') }}" class="card-img-top" alt="...">
                          {{-- <img src="{{ url('storage/app/public/images/service/'.$service->image) }}"> --}}
                          <div class="card-body">
                              <h5 class="card-title">{{ $service->title ?? '' }}</h5>
                              <p class="card-text">
                                {{ Str::substr($service->description, 0, 120)  ?? '' }}
                              </p>
                          </div>
                      </div>
                  </div>
              @endforeach

    </div>
     
  </section>



  <!-- For Introduction of KTM Logistics -->

  <section class="intro_section" id="intro_section">

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
              
             <div class="latestnews_card">
                <h5 class="latestnews_title">Latest News</h5>

                @foreach ($news as $object)
                    <ul class="latestnews_text">
                        <li><a href="{{ route('render_posts', $object->id) }}">{{ $object->title }}</a></li>
                    </ul>
                @endforeach

            </div>

              </div>
          </div>
      
  </section>


  <div class="row">
      <div class="col-md-9">
      @include('portal.includes.allInOne')
    </div>
    <div class="col-md-3">
    </div>

</div>






</div>
