@extends('frontend.master')

@section('head')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    {{--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}

    <style>
        body{
        background-color: #525252;
        }
        .centered-form{
        margin-top: 80px;
        }

        .centered-form .panel{
        background: rgba(255, 255, 255, 0.8);
        box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }
    </style>
@endsection
<!------ Include the above in your HEAD tag ---------->
@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ju lutem, regjistrohuni për të përfituar garancinë!</small></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('client.post') }}" method="POST" id="signupForm">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group { $errors->has('first_name') ? 'has-error' : '' }}">
                                        <input type="text" name="first_name" id="first_name" class="form-control input-sm" value="{{ old('first_name') }}" placeholder="Emri*">
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group { $errors->has('last_name') ? 'has-error' : '' }}">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm"value="{{ old('last_name') }}" placeholder="Mbiemri*">                                 @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group { $errors->has('tel') ? 'has-error' : '' }}">
                                <input type="number" name="tel" id="tel" class="form-control input-sm" value="{{ old('tel') }}" placeholder="Nr Telefoni*">                                 @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('tel') }}</span>
                                @endif
                            </div>

                            <div id="example2">
                                <div class="form-group { $errors->has('city') ? 'has-error' : '' }}">
                                    <select name="city" id="city" class="form-control city">
                                        <option value="">Qyteti</option>
                                        @foreach($cities as $city)
                                            <option  {!! (old('city') == $city->id) ? 'selected' : ''!!} value="{{$city->id}}"> {{$city->name}} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>

                                <div class="form-group { $errors->has('njesia') ? 'has-error' : '' }}">
                                    <select name="njesia" id="njesia" class="form-control njesia">
                                        @if (old('njesia'))
                                            <option  selected value="old('njesia')"> {{ old('njesia')  }} </option>
                                        @endif
                                    </select>
                                    @if ($errors->has('njesia'))
                                        <span class="text-danger">{{ $errors->first('njesia') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group { $errors->has('address') ? 'has-error' : '' }}">
                                <input type="text" name="address" id="address" class="form-control input-sm" value="{{ old('address') }}" placeholder="Adresa*">                                 @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Numri serial i Dekoderit">--}}
                            {{--</div>--}}
                            <div class="form-group ">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control input-sm" placeholder="Adresa e-mail">
                            </div>

                            <div class="form-group ">
                                <input type="text" name="sn" value="{{ old('sn') }}" id="sn" class="form-control input-sm" placeholder="Numri Serial">
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Regjistrohu" class="btn btn-info btn-block">
                            </div>
                            {{--<input type="submit" value="Regjistrohu" class="btn btn-info btn-block">--}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<form>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="exampleInputEmail1">Email address</label>--}}
                        {{--<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">--}}
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="exampleInputPassword1">Password</label>--}}
                        {{--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">--}}
                    {{--</div>--}}
                    {{--<div class="form-group form-check">--}}
                        {{--<input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
                        {{--<label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}
@endsection

@section('javascript')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="vendor/cascading-dropdown/jquery.cascadingdropdown.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#example2').cascadingDropdown({
                textKey: 'label',
                valueKey: 'value',
                selectBoxes: [
                    {
                        selector: '.city',
                        url: '{{ route('voyager.get_cities') }}'
                    },
                    {
                        selector: '.njesia',
                        requires: ['.city']
                    }
                ]
            });


            $('#city').on('change', function (e) {

                if ($(this).val()){

                    var url = "{{ route('voyager.get_njesia', [ 'city' => 'cityId']) }}";
                    url = url.replace('cityId',$(this).val());

                    $.ajax({
                       'url' : url,
                        success : function (data) {
                            if(data.length){
                                $('#njesia').empty();
                                data.forEach(function (item) {
                                    $('#njesia').append('<option value="'+item.name+'">'+item.name+'</option> ');
                                });
                            }

                        },
                        error : function (data) {
                            console.log(data);
                        }
                    });
                }else{
                    $('#njesia').empty();
                }

            });


        });
    </script>
@endsection

