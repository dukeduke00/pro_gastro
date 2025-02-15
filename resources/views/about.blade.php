
@vite(['resources/css/about.css'])

@extends('layout')

@section('page_name')
   About
@endsection

@section('content')
    <section class="about">
        <h1>About ProGastro</h1>
        <p>Welcome to ProGastro, your one-stop shop for high-quality gastro equipment. We specialize in selling professional kitchen tools, including high-performance knives, butcher tools, and various other essential kitchen items. Whether you’re a chef, butcher, or food enthusiast, ProGastro has everything you need to create the perfect culinary experience.</p>

        <p>Our mission is to provide top-notch products at competitive prices, ensuring that all of our customers have access to the best tools for their culinary needs. With years of experience in the industry, we are committed to delivering excellence and service you can trust.</p>

        <h2>Our Location</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27899.678993208483!2d18.060654263923176!3d44.73485283463219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475e822e8c4ed5b9%3A0xfde3c70c31346401!2s74000%20Doboj!5e1!3m2!1sen!2sba!4v1740086613727!5m2!1sen!2sba" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@endsection
