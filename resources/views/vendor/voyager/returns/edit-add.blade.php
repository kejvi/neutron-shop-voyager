@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #wait-screen{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f3f7ff;
            z-index: 999;
        }

        #clock{
            position: absolute;
            top: 45%;
            left: 45%;
            font-weight: bold;
            font-size: 20px;
        }

        .centered{
            position: absolute;
            top: 40%;
            left: 40%;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
@stop

@section('page_title', __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular)


@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> 
        {{ __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}

    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          id="returnsForm"
                          class="form-edit-add"
                          action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(!is_null($dataTypeContent->getKey()))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                                    @endif
                                @endforeach
                            </div>

                            <div id="errors" class="alert alert-danger" style="display: none;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{(!is_null($dataTypeContent->getKey()) ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = isset($row->details->display) ? $row->details->display : NULL;

                                     $user = Auth::user();

                                     if($row->field == 'status'){
                                         if(!Voyager::can('approve_returns')){
                                             continue;
                                         }
                                     }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{isset($row->details->legend->align) ? $row->details->legend->align : 'center'}}" style="background-color: {{isset($row->details->legend->bgcolor) ? $row->details->legend->bgcolor : '#f0f0f0'}};padding: 5px;">{{$row->details->legend->text}}</legend>
                                @endif
                                @if (isset($row->details->formfields_custom))
                                    @include('voyager::formfields.custom.' . $row->details->formfields_custom)
                                @else
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ isset($display_options->width) ? $display_options->width : 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label for="name">{{ $row->display_name }}</label>
                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                        @if($row->type == 'relationship')
                                            @include('voyager::formfields.relationship', ['options' => $row->details])
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button id="submit-return-form" type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="wait-screen" style="display: none;">
        <span id="clock"></span>
        <span class="centered">Ju lutem Prisni qe kerkesa juaj te konfirmohet</span>
    </div>
@stop

@section('javascript')

    @if($dataTypeContent->getKey() == null)
        <script>
            $(document).ready(function () {
                window.returned_id = 0;
                console.log('test');
                $('#submit-return-form').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    $form = $('#returnsForm');

                    $.ajaxSetup({
                        headers:
                            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });

                    $.ajax({
                        url : '{{ route('voyager.returns.store') }}',
                        type : 'POST',
                        data : $form.serialize(),

                        success : function (data) {
                            if(data.success == 'false'){
                                if(data.errors){
                                    $('#errors').empty();
                                    $('#errors').css('display', 'block');

                                    for( err in data.errors ){
                                        $('#errors').append('<li>'+data.errors[err]+'</li>');
                                    }
                                }
                            }

                            if(data.success == true){
                                window.returned_id = data.data.id;

                                $('#errors').css('display', 'none');

                                displayWaitScreen();

                                var threemin = new Date().getTime() + 180000;

                                $('#clock').countdown(threemin, function(event) {
                                    $(this).html(event.strftime('%M minuta %S sekonda'));

                                    checkIfApproved();

                                }).on('finish.countdown', function() {
                                    // render something
                                    console.log('finished');
                                    autoRejectReturn();
                                    hideWaitScreen();

                                });

                            }
                        },
                        error : function (data) {
                            console.log(data);
                        }
                    });


                });

                function checkIfApproved() {
                    $.ajax({
                        url : '{{ route('voyager.returns.check_if_approved') }}'+ '?id='+window.returned_id,
                        type : 'GET',
                        success : function (data) {
                            if(data.data.approved == 'true'){
                                //redirect to view
                                var url = "{{ route('voyager.returns.show' ,  'returned_id') }}?message=true";
                                url = url.replace('returned_id',window.returned_id);
                                window.location.href = url;
                            }
                        },
                        error : function (data){
                        }
                    })

                }
                
                function autoRejectReturn() {
                    $.ajax({
                        url : '{{route('voyager.returns.autoreject')}}',
                        type : 'POST',
                        data: {
                            'id': window.returned_id
                        },

                        success: function (data) {
                            // if(data.data.approved == 'false'){
                                //redirect to view
                            console.log(data);
                            console.log(data.data.returned);
                                var url = "{{ route('voyager.returns.show' ,  'returned_id') }}?message=true";
                                url = url.replace('returned_id',window.returned_id);
                                window.location.href = url;
                            // }
                        },
                        error: function (data) {
                            console.log(data)
                        }
                    })
                }


                function displayWaitScreen() {
                    $('#wait-screen').css('display','block');
                }

                function hideWaitScreen() {
                    $('#wait-screen').css('display','none');
                }

            });
        </script>
    @endif

@stop
