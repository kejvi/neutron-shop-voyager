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
                                    @if($data->transferuar==1)
                                        {{-- <td style="text-align:center;">{{$data->id}}</td> --}}
                                        <td style="text-align:center;">{{$data->emertimet}}</td>
                                        <td style="text-align:center;">{{$data->sn}}</td>
                                        {{-- <td style="text-align:center;">{!! Form::checkbox("transfertat[]", $data->id) !!}</td> --}}
                                        <td style="text-align:center;">
                                            <input type="checkbox" name="{{$data->artikull_id}}">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="form-group">
                            {{-- <label for="title">Zgjidh Qytetin:</label> --}}

                            <select name="qyteti" id="qytetipostes" class="form-control" style="width:350px; float: left; margin-right:24px;">
                                <option value="">--- Zgjidh Qytetin ---</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>

                            {{-- </div>
                            <div class="form-group"> --}}
                            {{-- <label for="title">Zgjidh Pikën Postare:</label> --}}
                            <td>
                                {{-- <select name="pika" id="pikapostes" class="form-control" style="width:350px; float: right;">
                                    <option value="">--- Zgjidh Pikën Postare ---</option>
                                    @foreach ($pikat as $pika)
                                        <option value="{{ $pika }}">{{ $pika }}</option>
                                    @endforeach
                                </select> --}}

                                <select name="pika" id="pikapostes" class="form-control" style="width:350px;float: right;">
                                    {{--<option value="">--- Zgjidh Piken Postare ---</option>--}}
                                </select>

                        </div>
                        <br><br><br>

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

            $('#qytetipostes').on('change', function (e) {

                if ($(this).val()){

                    var url = "{{ route('voyager.get_offices', [ 'city' => 'cityId']) }}";
                    url = url.replace('cityId',$(this).val());

                    $.ajax({
                        'url' : url,
                        success : function (data) {
                            if(data.length){
                                $('#pikapostes').empty();
                                data.forEach(function (item) {
                                    $('#pikapostes').append('<option value="'+item.id+'">'+item.name+'</option> ');
                                });
                            }
                        },
                        error : function (data) {
                            console.log(data);
                        }
                    });
                }else{
                    $('#pikapostes').empty();
                }

            });



            $('#button').on('click', function(e) {
                e.preventDefault();
                var qyteti = $('select[name="qyteti"]').val();
                var pika = $('select[name="pika"]').val();
                var selected = [];
                selected.push($('#qytetipostes').val());
                selected.push($('#pikapostes').val());
                $('input[type=checkbox]').each(function() {
                    if ($(this).is(":checked")) {
                        selected.push($(this).attr('name'));
                    }
                });

                var data = { value : selected };
                var klo = JSON.stringify(data, null, 4);

                $.ajax({
                    type: "POST",
                    url: '{{ route('voyager.transfer-to-offices.store') }}',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        if(!alert('Artikujt u transferuan me sukses!')){window.location.reload();}
                    }
                });
            });
        });

    </script>
@endsection