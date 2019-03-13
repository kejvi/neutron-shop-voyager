@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->display_name_plural)

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <form action="" method="get">
                            <div class="row">

                                <div class="col-sm-2">
                                    <input type="text" class="form-control daterange" name="daterange" id="daterange" value="{!! (isset($monthFirstDate) ? $monthFirstDate. ' - ' . $monthEndDate  : '') !!}">
                                </div>

                                <div class="col-sm-2">
                                    <select name="site" id="site" class="form-control">
                                        <option value="">Filiali</option>
                                        @foreach($sites as $site)
                                            <option @if($selectedSite == $site->slug) selected @endif value="{{ $site->slug }}">{{ $site->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select name="branch" id="site" class="form-control">
                                        <option value="">Dega</option>
                                        @foreach($branches as $branch)
                                            <option @if($selectedBranch == $branch->slug) selected @endif value="{{ $branch->slug }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-default" style="margin-top: 0px; ;">Filter</button>
                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">

                            <hr>

                            <div class="col-sm-3 text-center">
                                {{ $totalShitur }}  <br>
                                <h4> Shitur	</h4>
                            </div>


                            <div class="col-sm-3 text-center">
                                {{ $totalKthyer }}  <br>
                                <h4> Kthime	</h4>
                            </div>

                            <div class="col-sm-3 text-center">
                                {{ number_format($total_leke)  }} Lekë <br>
                                <h4> Leke nga shitjet	</h4>
                            </div>

                            <div class="col-sm-3 text-center">
                                {{ $dergesa }} <br>
                                <h4> Dergesa e Plote </h4>
                            </div>


                            {{--<div class="col-sm-3 text-center">--}}
                                {{--{{ $gjendja  }}  <br>--}}
                                {{--<h4> Gjendja Aktuale </h4>--}}
                            {{--</div>--}}
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {

            //default values
            var start = moment().startOf('month').format('DD/M/YYYY');
            var end = moment().endOf('month').format('DD/M/YYYY');

            @if($monthFirstDate )
                start = "{!! $monthFirstDate !!}";
            @endif

                    @if($monthFirstDate )
                end = "{!! $monthEndDate !!}";
            @endif

            $('.daterange').daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: 'DD/M/YYYY'
                },
                opens: 'right',
                autoUpdateInput: false,
            },function(start, end, label) {
                $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            });


        });
    </script>
@endsection