@component('mail::message')
  <h2>New Contact Form Submission</h2>
  <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
  <p><strong>Subject:</strong> {{ $subject }} </p>
  <p><strong>Message:</strong> {!! $body !!} </p>
@endcomponent
