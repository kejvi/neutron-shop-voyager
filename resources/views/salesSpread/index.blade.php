
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'POS')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-angle-right"></i>Importo file .cvs per te kryer perditesimin e shitjeve te artikujve.
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
                <form action="{{url('admin/spread')}}" method="post", enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="file" name="file" >
                    <p style="color:red">{{$errors->first('file')}}</p>
                    <input type="submit" value="import" class="btn  btn-primary" >
                </form>
            </div>
        </div>

        @if(Session::has('articles_not_found'))
           @foreach(Session::get('articles_not_found') as $item)
               {!! print_r($item) !!}
           @endforeach
        @endif

    </div>
@stop


