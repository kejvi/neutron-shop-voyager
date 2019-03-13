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
                <div class="panel panel-bordered table-condensed">
                    <div class="panel-body">

                        <form action="" method="get">
                            <div class="row">

                                <div class="col-sm-2">
                                    <input type="text" class="form-control daterange" name="daterange" id="daterange" value="{!! (isset($monthFirstDate) ? $monthFirstDate. ' - ' . $monthEndDate  : '') !!}">
                                </div>

                                <div class="col-sm-2">
                                    <select name="site" id="site" class="form-control">
                                        <option value="">Filiali</option>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select name="branch" id="branch" class="form-control">
                                        <option value="">Dega</option>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select name="zyrat" id="zyrat" class="form-control"></select>
                                </div>

                                <div class="col-sm-2">
                                    <select name="users" id="users" class="form-control"></select>
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-default" style="margin-top: 0px; ;">Filter</button>

                                    <button type="submit" class="btn btn-success" style="margin-top: 0px; " id="export"
                                            onclick="tableToExcel('tablename', 'Worksheet1', 'raporte.xls')">Excel</button>

                                    <button type="submit" class="btn btn-default" style="margin-top: 0px; " id="export-with-barcode">Excel(me barkode)</button>
                                </div>
                                {{--sherbern per shkarkimin e exelit. mos e fshij. Urdher nga Enea Dume--}}
                                <a id="dlink"  style="display:none;"></a>

                            </div>
                        </form>

                        <table class="table table-condensed table-bordered" id="tablename">
                            <tbody>

                            @if(count($table))
                                @foreach($table as $siteIndex => $site)

                                    <tr class="bg-danger" colspan="3">
                                        {{--<th>--}}
                                        <td>  <b>Filiali</b> : {{ ucfirst($siteIndex)  }}  </td>
                                        {{--<td><b> Dergesa e marre  </b>: {{ isset($site['dergesa'] ) ? $site['dergesa']  : ''}}</td>--}}
                                        <td><b>Shitur</b> : {{ isset($site['shitur']) ? $site['shitur'] : '' }}</td>
                                        {{--<td><b>Gjëndje</b> : {{ isset($site['hyrje']) ? $site['hyrje'] : '' }}</td>--}}
                                        <td><b>Lek</b> : {{ isset($site['lek']) ? number_format($site['lek']) : '' }}</td>
                                        <td><b>Kthime</b> : {{ isset($site['kthime']) ? $site['kthime'] : '' }}</td>
                                        {{--</th>--}}
                                        {{--<th colspan="2">--}}
                                        {{--</th>--}}
                                    </tr>

                                    @foreach($site['deget'] as $branchIndex => $branch)

                                        @php
                                            // var_dump($branchIndex);die();
                                        @endphp

                                        <!- Dega template->
                                        <tr class="bg-info">

                                            <td>  <b>Dega</b> : {{ ucfirst($branchIndex)  }}  </td>
                                            {{--<td> <b> Dergesa e marre  </b>: {{ isset($branch['dergesa'] ) ? $branch['dergesa']  : ''}}</td>--}}
                                            <td> <b>Shitur</b> : {{ isset($branch['shitur']) ? $branch['shitur'] : '' }} </td>
                                            {{--<td><b>Gjëndje</b> : {{ isset($branch['hyrje']) ? $branch['hyrje'] : '' }}</td>--}}
                                            <td><b>Lek</b> : {{ isset($branch['lek']) ? number_format($branch['lek']) : '' }}</td>
                                            <td><b>Kthime</b> : {{ isset($branch['kthime']) ? $branch['kthime'] : '' }}</td>

                                            {{--<td></td>--}}
                                            {{--<th colspan="2">--}}
                                                {{-------}}
                                                {{-----  -----}}
                                                {{-------}}
                                            {{--</th>--}}
                                            {{--<td><b>Total Shitur</b> : {{ isset($branch['shitur'] ) ? $branch['shitur']  : '' }} </td>--}}
                                            {{--<td><b>Total Lek</b> : {{ isset($branch['lek'] ) ? number_format($branch['lek'])  : '' }} L </td>--}}
                                        </tr>
                                        <!- Dega template->

                                        @if(isset($branch['zyrat']))
                                            @foreach($branch['zyrat'] as $officeIndex => $office)
                                                <!-zyra tmp->
                                                <tr class="bg-warning">
                                                    <td>  <b>Zyra</b>  : {{ ucfirst($officeIndex) }}  </td>
                                                    {{--<td> <b> Dergesa e marre  </b>: {{ isset($office['dergesa'] ) ? $office['dergesa']  : ''}} </td>--}}
                                                    <td> <b>Shitur</b> : {{ isset($office['shitur']) ? $office['shitur'] : '' }} </td>
                                                    {{--<td> <b>Gjëndje</b> : {{ isset($office['hyrje']) ? $office['hyrje'] : '' }} </td>--}}
                                                    <td> <b>Lek</b> : {{ isset($office['lek']) ? number_format($office['lek']) : '' }} </td>
                                                    <td> <b>Kthime</b> : {{ isset($office['kthime']) ? $office['kthime'] : '' }} </td>

                                                    {{--<td></td>--}}
                                                    {{--<th colspan="2">--}}
                                                        {{-------}}
                                                        {{----- -----}}
                                                        {{-------}}
                                                    {{--</th>--}}
                                                    {{--<td>--}}
                                                        {{--<b>Shitur</b> : {{ isset($office['shitur']) ? $office['shitur'] : '' }}--}}
                                                        {{--<b>Gjëndje</b> : {{ isset($office['hyrje']) ? $office['hyrje'] : '' }}--}}
                                                        {{--<b>Kthime</b> : {{ isset($office['kthime']) ? $office['kthime'] : '' }}--}}

                                                    {{--</td>--}}
                                                    {{--<td> <b>Total Lek</b> : {{ (isset($office['lek'] ) ?number_format( $office['lek'])  : '') }} L</td>--}}
                                                </tr>
                                                <tr>
                                                    <th> Punonjesi </th>
                                                    <th> Total Shitur </th>
                                                    <th> Total Leke</th>
                                                    <th>    </th>
                                                </tr>
                                                @if(isset($office['users']))
                                                    @foreach($office['users'] as $username => $user)
                                                        <tr>
                                                            <td>{{ $username  }} </td>
                                                            <td> {{ $user['produkte'] }}</td>
                                                            <td> {{  number_format($user['shitur']) }} </td>
                                                            <td>    </td>
                                                        </tr>
                                                    @endforeach

                                                @endif
                                                <!-zyra tmp->
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endforeach

                            @else
                                <div class="text-center text-info">
                                    nuk ka te dhena
                                </div>
                            @endif
                            </tbody>
                        </table>

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


        //get filiali
        $('#site').select2({
            allowClear: true,
            placeholder: "Filiali",
            ajax: {
                url: '{{ route('get.sites.by-role') }}',
                dataType: 'json'
            }
        });

        @if(isset($selectedSite) && $selectedSite !== "")
            $("#site").empty().append('<option value="{{$selectedSite->id}}">{{$selectedSite->name}}</option>').val('{{$selectedSite->id}}').trigger('change');
        @endif

        $('#branch').select2({
            allowClear: true,
            placeholder: "Dega",
            ajax: {
                url: '{{ route('get.branches.by-role') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        filiali: $('#site').val()
                    }
                    return query;
                },
                dataType: 'json'
            }
        });

        @if(isset($selectedBranch) && $selectedBranch !== "")
        $("#branch").empty().append('<option value="{{$selectedBranch->id}}">{{$selectedBranch->name}}</option>').val('{{$selectedBranch->id}}').trigger('change');
        @endif

        $('#zyrat').select2({
            allowClear: true,
            placeholder: "Zyra Postare",
            ajax: {
                url: '{{ route('get.offices.by-role') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        branch: $('#branch').val()
                    }
                    return query;
                },
                dataType: 'json'
            }
        });

        @if(isset($selectedZyra) && $selectedZyra !== "")
        $("#zyrat").empty().append('<option value="{{$selectedZyra->id}}">{{$selectedZyra->name}}</option>').val('{{$selectedZyra->id}}').trigger('change');
        @endif
        $('#users').select2({
            allowClear: true,
            placeholder: "Punojesit",
            ajax: {
                url: '{{ route('get.users.by-role') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        office: $('#zyrat').val()
                    }
                    return query;
                },
                dataType: 'json'
            }
        });

        @if(isset($selectedUser) && $selectedUser !== "" )
         $("#users").empty().append('<option value="{{$selectedUser->id}}">{{$selectedUser->name}}</option>').val('{{$selectedUser->id}}').trigger('change');
        @endif


    });

    // var tableToExcel = (function() {
    //     var uri = 'data:application/vnd.ms-excel;base64,'
    //         , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    //         , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    //         , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    //     return function(table, name) {
    //         console.log(document.getElementById(table).innerHTML);
    //         // if (!table.nodeType) table = document.getElementById(table)
    //         // var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    //         // window.location.href = uri + base64(format(template, ctx))
    //     }
    // })();
    var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })();


    $('#export-with-barcode').on('click', function (e) {
        e.preventDefault();

            window.open('{{ route('reports.export.with_barcodes')  }}', '_blank');
    });
</script>
@endsection