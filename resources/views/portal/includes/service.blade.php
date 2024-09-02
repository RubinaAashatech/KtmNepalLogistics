  <!-- For Cards and Stuffs -->
  <section class="delivery">
      <div class="container">
          <div class="row">
              @foreach ($services as $service)
                  <div class="col-md-3">
                      <div class="card">
                          <img src="{{ url('uploads/service/' . $service->image ?? '') }}" class="card-img-top" alt="...">
                          <div class="card-body">
                              <h5 class="card-title">{{ $service->title ?? '' }}</h5>
                              <p class="card-text">
                                  {{ Str::substr($service->description, 0, 200)  ?? '' }}
                              </p>
                          </div>
                      </div>
                  </div>
              @endforeach

               @include('portal.includes.news') 
          </div>
      </div>
  </section>
