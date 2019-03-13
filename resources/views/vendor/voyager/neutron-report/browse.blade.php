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
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;font-weight:bold">Nr</th>
                                    <th scope="col" style="text-align:center;font-weight:bold">Pika Postare</th>
                                    <th scope="col" style="text-align:center;font-weight:bold">Kodi Postar</th>
                                    <th scope="col" style="text-align:center;font-weight:bold">Dergesa e Plote</th>
                                    <th scope="col" style="text-align:center;font-weight:bold">Shitur</th>
                                    <th scope="col" style="text-align:center;font-weight:bold"> Gjendja Aktuale</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offices as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->postal_code}}</td>
                                        <td>{{$row->getSentArticles($monthFirstDate,$monthEndDate) }}</td>
                                        <td>{{$row->getTotalSold($monthFirstDate,$monthEndDate)  }}</td>
                                        <td>{{$row->getCurrentState($monthFirstDate,$monthEndDate)  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="pull-right">
                                {{ $offices->links() }}
                            </div>

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