@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'POS')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-angle-right"></i> POS - {{$post_office_name}}
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">

        <div class="row">
            <div class="col-md-12">

                {!! Form::open(array('route' => 'voyager.pos.store'))  !!}

                    <div class="input-group col-md-7" style="margin: 5px">

                        {!! Form::text('sn', null,['class'=>'form-control', 'style' => "float: left; width:70%; margin-left: 15px",
                        'placeholder' => 'Barkodi' ,'autofocus' => 'autofocus'])!!}

                        <div class="input-group col-md-3" style="float: right">
                            {!! Form::button('Shto', ['type'=>'submit', 'class'=>'btn btn-primary', 'style'=> 'margin-top:0px']) !!}
                        </div>

                    </div>

                {!! Form::close() !!}


                <div class="col-md-6" style="float: left; margin: 5px; height:1000px;">

                    {{--@if(Session::has('message'))--}}
                        {{--<div class="alert alert-success">{{Session::get('message')}}</div>--}}
                    {{--@endif--}}

                    <div class="panel">
                        <div class="" style="font-size:32; font-weight:bold">
                            <h4>Artikujt në gjëndje</h4>
                        </div>

                        <div class="">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;font-weight:bold">Nr</th>
                                        <th scope="col">Emërtimi</th>
                                        <th scope="col">Numri Serial</th>
                                        <th scope="col">Çmimi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($artikujt as $key => $data)
                                    <tr>
                                        <td style="text-align:center;font-weight:bold">{{$data->id}}</td>
                                        <td>{{$data->emertimet}}</td>
                                        <td>{{$data->sn}}</td>
                                        <td>{{$data->Cmimi}} L</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                <div class="pull-right">
                                    {{ $artikujt->links() }}
                                </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-5" style="float: left; margin-left: 0px;" id="div1">
                    <div class="panel">
                        <div class="" style="font-size:32;font-weight:bold">
                            <h4>Posta Shqiptare | Shitje Neutron Dekoder DVB-T2 HD</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark" id="sales-table">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;font-weight:bold">Numri Serial</th>
                                    <th scope="col">Emërtimi</th>
                                    {{--<th scope="col">Sasia</th>--}}
                                    <th scope="col">Cmimi</th>
                                    <th>Veprime</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($artikujtPerShitje as $key => $data)
                                    <tr>
                                        <td style="text-align:center;font-weight:bold">{{$data->sn}}</td>
                                        <td>Neutron Dekoder DVB-T2 HD</td>
                                        {{--<td>1</td>--}}
                                        <td>{{$data->cmimi}}</td>

                                        <td>
                                            {!! Form::open(array('route'=>['voyager.pos.destroy',$data->sn],'method'=>'DELETE')) !!}
                                            {!! Form::button('Fshi',['class'=>'btn btn-danger','type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td style="font-size: 22px;font-weight: bold;">Totali</td>
                                    <td></td>
                                    <td>{{$totali}} L</td>
                                    <td ></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <iframe id="print_frame" name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                    </div>
                </div>



                <div class="input-group col-md-5" style="float: left;">
                    {!! link_to_route('voyager.report','Bilanci Total', [] ,['class' => 'btn btn-warning','style'=>'margin-left: 20px;margin-right: 5px;']) !!}
                    {!! link_to_route('voyager.daily','Bilanci Ditor', [] ,['class' => 'btn btn-warning','style'=>'margin-left: 5px;margin-right: 5px;']) !!}
                        {{--{!! Form::button('Ruaj dhe Printo', ['type'=>'submit', 'class'=>'btn btn-primary', 'target' => "_blank"]) !!}--}}
                    <button class="btn btn-primary pull-right" id="open-shitje-modal" style="float: right">Ruaj Shitjen</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="client-reg-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <b> Të dhënat tuaja duhen per garancinë e produktit </b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('route' => 'voyager.pos.storePrint', 'id'=>'p'))  !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-9 col-sm-9 col-md-9">

                                </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group { $errors->has('first_name') ? 'has-error' : '' }}">
                                    <input type="text" name="first_name" id="first_name" class="form-control input-sm" value="{{ old('first_name') }}" placeholder="Emri">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group { $errors->has('last_name') ? 'has-error' : '' }}">
                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm"value="{{ old('last_name') }}" placeholder="Mbiemri">                                 @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group { $errors->has('tel') ? 'has-error' : '' }}">
                                    <input type="number" name="tel" id="tel" class="form-control input-sm" value="{{ old('tel') }}" placeholder="Nr Telefoni">                                 @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('tel') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group { $errors->has('address') ? 'has-error' : '' }}">
                                    <input type="text" name="address" id="address" class="form-control input-sm" value="{{ old('address') }}" placeholder="Adresa">                                 @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                            {{--<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Numri serial i Dekoderit">--}}
                            {{--</div>--}}

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group ">
                                    <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Adresa e-mail">
                                </div>
                            </div>

                            <a type="submit" href="{{ route('pos.print.fatura')}}"
                               class="btn btn-block btn-primary pull-right" id="print" style="float: right">Ruaj Shitjen
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



@section('javascript')

    <script>

        $(document).ready(function() {

            $.fn.extend({
                print: function() {
                    var frameName = 'print_frame';
                    var doc = window.frames[frameName];

                    if (!doc) {
                        $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
                        doc = window.frames[frameName];
                    }


                    var tbl =  $('#sales-table').clone();
                    var rows = '';

                    tbl.find('tbody td:last-child').remove();

                    tbl.find('tbody tr').each(function (i,item){
                        rows += $(item).html();
                        console.log(item);
                    });

                    var tpl = `
                       <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
                        <style>

                                    printed-div{
                                        display:block;
                                    }
                                    .logo-posta-print{
                                        width:75px;
                                        height:75px;
                                        display: list-item;
                                        list-style-image: url('../images/logoposta.png');
                                    }

                                    @media print{
                                     img {
                                          display: inline;
                                          visibility: visible;
                                          z-index : 99999;
                                     }
                                }

                            </style>
                      <div class="printed-div">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                        <td>
                                            <img src="https://www.postashqiptare.al/wp-content/uploads/2018/01/logoposta.png"
                                    alt="text" border="0" height="50" width="100" />
                                         </td>
                                        <td><b>Neutron Dekoder DVB-T2 HD </b> </td>
                                    <td>
                                    <img src="http://www.neutron.al/wp-content/uploads/2018/03/Neutro-logo-1-1.png"
                                    alt="text" border="0" height="50" width="100" /> </td>
                                        </tr>
                                        </table>
                                    <br>
                                    <br>
                                        <table width="100%" border="1 solid black" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Numri Serial</th>
                                                <th>Emërtimi</th>
                                                <th>Cmimi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                  @foreach($artikujtPerShitje as $key => $data)
                        <tr>
                            <td style="text-align:center;font-weight:bold">{{$data->sn}}</td>
                            <td align="center">Neutron Dekoder DVB-T2 HD</td>
                          <td align="center">{{$data->cmimi}} L</td>
                    </tr>
                    @endforeach
                                        </tbody>
                                        <tfoot>
                                <tr>
                                    <td style="font-size: 22px;font-weight: bold;">Totali</td>
                                    <td></td>
                                    <td align="center">{{$totali}} L</td>
                                </tr>
                                </tfoot>
                                    </table>

                                   <br>
                                   <br>
                                   <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                            <td> </td>
                                            <td align="right" style="font-size: 14px;font-weight: bold;">{{ $post_office_name }}</td>
                                            <td></td>
                                            <td ></td>
                                      </tr>
                                       <tr>
                                             <td> </td>
                                             <td align="right" style="font-size: 14px;font-weight: bold;">{{ $user_details }}</td>
                                             <td></td>
                                             <td ></td>
                                        </tr>
                                   </table>

                    </div>`;

                    doc.document.body.innerHTML = tpl;

                    window.frames["print_frame"].focus();
                   // doc.window.print();
                    document.getElementById('print_frame').contentWindow.print();

                    return this;
                }
            });

            // var table = document.getElementById('sales-table'), total = 0;
            // for (var i = 1; i < table.rows.length - 1; i++){
            //     total += parseInt(table.rows[i].cells[3].innerHTML);
            // }
            //
            // document.getElementById('totalSum').innerHTML = total + '  L';

            $('#open-shitje-modal').on('click', function (e) {
                $('#client-reg-modal').modal();
            });

            // $("#print").click(function(){
            //     $("#print").print();
            //
            // });


            $("#print").printPage({
                afterCallback : function () {
                    $('#p').submit();
                }
            });




        });

    </script>
@stop
