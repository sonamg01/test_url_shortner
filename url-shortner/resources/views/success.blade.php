@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h2>Short Link Generated Successfully</h2>
    <div class="mb-3">
        <input type="text" class="form-control" value="{{ session('short_url') }}" id="shortUrl">
        <button class="btn btn-secondary mt-2" onclick="copyToClipboard">Copy Url</button>
    </div>
</div>

<a href="/" class="btn btn-success">Create Another</a>
<a href="/links" class="btn btn-info">View All Links</a>


<script>
    function copyToClipboard(){
        var copyText = document.getElementById("shortUrl");
        copyText.select();
        document.execCommand("copy");
        alert("copied to clipboard")
    }
</script>
@endsection