@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    @if(\Illuminate\Support\Facades\Auth::user()->role->id == 2)
                        Hello Admin

                        @elseif(\Illuminate\Support\Facades\Auth::user()->role->id == 1)
                        Hello customer

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
