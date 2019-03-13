<html>
    <head>

    </head>
    <body>
        <div class="printed-div">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <img src="https://www.postashqiptare.al/wp-content/uploads/2018/01/logoposta.png"
                             alt="text" border="0" height="75" width="75" />
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
                        <td align="center">{{$data->Cmimi}} L</td>
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
                    <td align="right" style="font-size: 14px;font-weight: bold;">Data: {{ date('d-m-Y H:i:s') }}</td>
                    <td></td>
                    <td ></td>
                </tr>
                <tr>
                    <td> </td>
                    <td align="right" style="font-size: 16px;font-weight: bold;">{{ $post_office_name }}</td>
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

        </div>
    </body>
</html>