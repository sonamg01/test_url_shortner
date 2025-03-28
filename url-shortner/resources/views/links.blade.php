@extends('layouts.app')

@section('content')

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-end mb-3">
    <h2 >Your Shorted Link </h2>
    <a href="/" class="btn btn-success mt-4">Create Another</a>
    </div>
    @if (session('message'))

    <div class="alert alert-success">{{ session('message') }}</div>

    @endif
    <table class="table">
        <thead>

            <th>Short Url</th>
            <th>Original Url</th>
            <th>Expires At</th>
            <th>Stutas</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
            <tr>
                <td>
                    @if ($link->status == 0)
                    <a href="{{ $link->status ? url( '/short/'. $link->short_url) : '#' }}" target="_blank" >{{ url('/short/' . $link->short_url ) }} </a>
                    @else
                    <span class="disabled-link">{{ $link-> short_url}}</span>
                    @endif
                </td>
                <td>{{ $link-> original_url }}</td>

                <td>{{ $link-> expires_at }}</td>
                <td>{{ $link->status ? 'Inactive' : 'Active' }}</td>
                <td class="d-flex ">
                    <a href="{{ route('links.edit', $link->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('links.destroy', $link->id) }}" method="post" onsubmit="return confirm('Are Your Sure To Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ms-2"> Delete</button>
                    </form>
                    <form action="{{ route('links.toggleStutas', $link->id) }}" method="post" style="display: inline;">
                        @csrf
                        <button class="btn btn-info ms-2" type="submit">{{ $link->status ? 'Active' : 'Inactive' }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>




@endsection