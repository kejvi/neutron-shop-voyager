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

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">Emertimi</th>
                                <th scope="col" style="text-align:center;">Serial Number</th>
                                <th scope="col" style="text-align:center;">Zgjidh</th>
                            </tr>

                            </thead>
                            <tbody>

                            @foreach($artikujt as $key => $data)
                                <tr>
                                    @if($data->transferuar == 0)
                                        {{-- <td style="text-align:center;">{{$data->id}}</td> --}}
                                        <td style="text-align:center;">{{$data->emertimet}}</td>
                                        <td style="text-align:center;">{{$data->sn}}</td>
                                        {{-- <td style="text-align:center;">{!! Form::checkbox("transfertat[]", $data->id) !!}</td> --}}
                                        <td style="text-align:center;">
                                            <input type="checkbox" name="{{$data->id}}">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                        <input type="button" id="button" value="Transfero" class="btn btn-success pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')


    <script>
        $(document).ready(function(){
            $('#button').on('click', function(e) {

                // Prevent the default action of the clicked item
                e.preventDefault();

                var selected = [];
                $('input[type=checkbox]').each(function() {
                    if ($(this).is(":checked")) {
                        selected.push($(this).attr('name'));
                    }
                });

                var data = { value : selected };
                var klo = JSON.stringify(data, null, 4);

                $.ajax({
                    type: "POST",
                    url: '{{ route('voyager.transfer-to-magazine.store') }}',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        //console.log("Value added " + klo);
                        //alert('Artikujt u transferuan me sukses!');
                        if(!alert('Artikujt u transferuan me sukses!')){window.location.reload();}
                    }
                });
                // TODO: Sweet Alert
                // https://github.com/t4t5/sweetalert
            });
        });
    </script>
@endsection