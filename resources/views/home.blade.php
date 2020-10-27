@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-header">Dashboard</div>
                @if (Auth::user()->advisor == 1)
                    @include('advisor.index')
                @else
                    @include('student.index')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
