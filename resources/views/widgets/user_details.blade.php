
<div class="row">
    <div class="col-sm-4">
        <div class="panel widget" style="margin-bottom:0;overflow:hidden;">
            <div class="panel-content">
                @if (isset($icon))<i class='{{ $icon }}'></i>@endif
                    <h5>{!! $title !!}</h5>
                <table class="table">
                    <tbody>
                    <tr>
                        <td><b>Emri Mbiemri</b></td> <td> {{ $user->name }} </td>
                    </tr>

                    <tr>
                        <td><b>Username</b></td> <td> {{ $user->username }} </td>
                    </tr>

                    <tr>
                        <td><b>Email</b></td> <td> {!! (isset($user->email)) ?  $user->email : '' !!}  </td>
                    </tr>

                    <tr>
                        <td><b>Zyra Postare</b></td> <td> {!! (isset($office)) ?  $office->name : '' !!} </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
