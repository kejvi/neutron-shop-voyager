
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'POS')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-angle-right"></i>Importo file .cvs per te regjistruar perdoruesit.
        </h1>
    </div>
    <div class="row">
        <div class="col-md-7" align="right">
            <hr>
            {{--<h4>Data: {{ date('d-m-Y H:i:s') }}</h4>--}}
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-md-7" align="right">
            <div style="padding:10px;", class="col-md-12">
                <form action="{{url('admin/register-users')}}" method="post", enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="file" name="file" >
                    <p style="color:red">{{$errors->first('file')}}</p>
                    <input type="submit" value="import" class="btn  btn-success" >
                </form>
            </div>
        </div>
    </div>
@stop


