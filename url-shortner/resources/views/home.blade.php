@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="text-center">Shorten your url</h2>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="/shorten" method="post">
                        @csrf

                        <div class="mb-3">
                            <input type="url" name="original_url" class="form-control" placeholder="Enter Your Url" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Generate</button>
                        <a href="/links" class="btn btn-info">View All Links</a>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection