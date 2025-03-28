@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h2>Edit Short Link</h2>
    <form action="{{ route('links.update', $link->id) }}" method="post">
        @csrf
        
        @method('PUT')
        <div>
            <label for="">Short Url</label>
            <input type="text" name="short_url" value="{{ old('short_url', $link->short_url) }}" id="" required>
        </div>
        <div>
            <label for="">Original Url</label>
            <input type="text" name="original_url" value="{{ old('original_url', $link->original_url) }}" id="" required>
        </div>
        <div>
            <label for="">Expires At</label>
            <input type="text" name="expires_at" value="{{ old('expires_at', $link->expires_at) }}" id="" required>
        </div>

        <button type="submit">Update</button>
    </form>
</div>

@if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


@endsection