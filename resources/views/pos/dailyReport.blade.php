@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'POS')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-angle-right"></i> Bilanci i Ditor i shitjeve
        </h1>
    </div>
    <div class="row">
        <div class="col-md-7" align="right">
            <h4>Data: {{ date('d-m-Y H:i:s') }}</h4>
        </div>
    </div>
    <br />


    <div class="page-content browse container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="reports-table">
                <thead>
                <tr>
                    <th>Numri Serial</th>
                    <th>Emertimi</th>
                    <th>Cmimi</th>
                    <th>Veprim</th>
                </tr>
                </thead>
                <tbody>
                @foreach($artikujt as $artikull)

                    <tr class="{!!  ($artikull->Cmimi < 0) ?  'text-danger' : '' !!} ">
                        <td>{{ $artikull->sn }} </td>
                        <td>{{ $artikull->emertimet }}</td>
                        <td>{{ $artikull->Cmimi }} Lekë</td>
                        <td>
                            <button class="btn btn-block btn-primary pull-right print" id="{{$artikull->sn}}" style="float: right">Riprinto</button>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>

                    <td></td>
                    <td style="font-size: 22px;font-weight: bold;">Totali</td>
                    <td id="totalSum">{{$totali }}  Lekë</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
    </div>
    <div class="row">
        <div class="col-md-12" align="right">
                <a type="submit" href="{{ route('pos.print.bilanci-ditor')}}"
                   class="btn btn-primary pull-right" id="print" style="float: right">Printo Bilancin Ditor
                </a>

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

                var rows = '';

                var tr = $(this).closest('tr').clone();
                tr.find('td:last-child').remove();
                rows += tr.html();

                var tpl = ` <b>Posta Shqiptare | Shitje Neutron Dekoder DVB-T2 HD<br>Kjo eshte nje kopje e fatures origjinale</b>
                                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Numri Serial</th>
                                                <th>Emërtimi</th>
                                                <!--<th>Sasia</th>-->
                                                <th>Cmimi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           `+rows+`
                                        </tbody>
                                    </table>
                                     <h4 align="right">{{ $user }} </h4>
                                     <h4 align="right">{{ $office }} </h4>`;


                doc.document.body.innerHTML = tpl;

                doc.window.print();

                return this;
            }
        });

        // var table = document.getElementById('reports-table'), total = 0;
        // for (var i = 1; i < table.rows.length - 1; i++) {
        //     total += parseInt(table.rows[i].cells[3].innerHTML);
        // }

        // document.getElementById('totalSum').innerHTML = total + '  L';
        //
        //
        // $('#open-shitje-modal').on('click', function (e) {
        //     $('#client-reg-modal').modal();
        // });


        $(".print").click(function(){
            $(this).print();

        });

        $("#print").printPage()

    });

</script>
@stop