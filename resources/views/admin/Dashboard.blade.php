@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>


    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Writter's</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $result['writters'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $result['users'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('img/user-avatar2.png') }}" alt="" class="writters fa-2x text-gray-300" />
                            <i class="writters fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Stories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $result['stories'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rate
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $result['rate'] }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $result['rate'] }}%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rate Stories</h6>
                </div>
                <div class="card-body" id="myBarChart">
                    @foreach ($counts as $count)
                        <div>
                            <h4 class="small font-weight-bold">Story Ratings {{ $count->title }}</h4>
                            <div style="display: flex; justify-content: space-evenly;">

                                @if ($count->average_rating >= 0.5 && $count->average_rating <= 5)
                                    @for ($i = 0.5; $i <= 5; $i++)
                                        @if ($i <= $count->average_rating)
                                            <span class="fa fa-star checked" style="cursor: pointer;"></span>
                                        @else
                                            @if ($i - 0.5 <= $count->average_rating)
                                                <span class="fa fa-star-half checked-half" style="cursor: pointer;"></span>
                                            @else
                                                <span class="fa fa-star" style="cursor: pointer;"></span>
                                            @endif
                                        @endif
                                    @endfor
                                @else
                                    Invalid Rate
                                @endif

                                {{ '(' . number_format($count->average_rating, 1) . ')' }}
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>


    </div>
@endsection
