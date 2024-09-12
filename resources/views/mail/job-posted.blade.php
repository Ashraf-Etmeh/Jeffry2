<h2>
    {{ $job->title }}
</h2>

<p>
    <!-- It is never too late to be what you might have been. - George Eliot -->
    Congrats! Your job is now live on our website.
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View your Job Listing</a>
</p>
