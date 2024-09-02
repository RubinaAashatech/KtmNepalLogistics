@include('portal.includes.styles.slick')

  <!-- For Advertisers and SLick Slider -->
  <section class="advertise">
    <div class="container text-center">
      
        <h1>Advertisers</h1>
      
      <div class="row multiple-items ">
        @foreach ($clients as $client)
        <div class="col-md-3">
          <img src="{{ url('uploads/client/'.$client->image) }}" alt="" width="100px" height="100px">
          {{-- <span class="text-center">{{ $client->name ?? '' }}</span> --}}
        </div>
        @endforeach
    </div>
  </section>