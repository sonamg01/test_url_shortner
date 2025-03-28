@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h2>Short Link Generated Successfully</h2>
    <div class="mb-3">
        <input type="text" class="form-control" value="{{ session('short_url') }}" id="shortUrl">
        <button class="btn btn-secondary mt-2" onclick="copyToClipboard()">Copy Url</button>
    </div>
</div>

<a href="/" class="btn btn-success">Create Another</a>
<a href="/links" class="btn btn-info">View All Links</a>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById("shortUrl");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Mobile ke liye

        navigator.clipboard.writeText(copyText.value).then(() => {
            alert("Copied to clipboard!");
        }).catch(err => {
            console.error("Failed to copy: ", err);
        });
    }
</script>

@endsection
