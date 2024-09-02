<form class="quick_contact form-inline row" method="POST" action="{{ route('request_contact') }}">
    @csrf
    <p class="quick_contact_title">
        Quick Contact
    </p>

    <div class="mb-2 ">
        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
    </div>


    <div class="mb-2">
        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
    </div>


    <div class="mb-2">
        <input type="phone" name="phone" class="form-control" id="phone" placeholder="Your Phone No." required>
    </div>


    <div class="mb-2">
        <textarea name="message" class="quick_contact_texarea" placeholder="Enter Your Message" required></textarea>
    </div>

    <button type="submit" class="btn btn-quick_contact mb-2">Submit</button>

</form>
