@vite(['resources/css/contact.css'])

@extends('layout')

@section('page_name')
    Contact
@endsection

@section('content')


    <div class="contact-container">
        <h2>Contact Us</h2>
        <form action="#" method="POST">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="input-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button class="contact_button" type="submit">Send Message</button>
        </form>
    </div>


@endsection
