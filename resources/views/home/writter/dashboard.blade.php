@extends('layouts.writer')
@section('title', 'Dashboard')
@section('content')
    <h3>Dashboard</h3>
    </button>
    <div class="card">
        <div class="card-story">
            <div class="number">{{ $result['stories'] }}</div>
            <div class="titel-story">
                Jumlah Cerita
                <img src="{{ asset('img/peper.webp') }}" alt="" class="icon" />
            </div>
        </div>
        <div class="card-reader">
            <div class="number">2</div>
            <div class="titel-reader">
                Jumlah Pembaca
                <img src="{{ asset('img/person.webp') }}" alt="" class="icon" />
            </div>
        </div>
    </div>

@endsection
