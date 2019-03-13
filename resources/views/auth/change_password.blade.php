@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'POS')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-angle-right"></i> Change Password
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-body">
                        <form method="post" action="{{route('voyager.post_change_password')}}" id="passwordForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="password" class="input-lg form-control" name="password" id="password1" placeholder="New Password" autocomplete="off">

                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" class="input-lg form-control" name="password_confirmation" id="password2" placeholder="Repeat Password" autocomplete="off">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

