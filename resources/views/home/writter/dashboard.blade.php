@extends('layouts.writer')
@section('title', 'Dashboard')
@section('content')
    <h3>Dashboard</h3>
    <button type="submit" class="add">
        <a href="">+ Tambah Cerita</a>
    </button>
    <div class="card">
        <div class="card-story">
            <div class="number">2</div>
            <div class="titel-story">
                Jumlah Cerita
                <img src="peper.webp" alt="" class="icon" />
            </div>
        </div>
        <div class="card-reader">
            <div class="number">2</div>
            <div class="titel-reader">
                Jumlah Pembaca
                <img src="person.webp" alt="" class="icon" />
            </div>
        </div>
    </div>

@endsection
