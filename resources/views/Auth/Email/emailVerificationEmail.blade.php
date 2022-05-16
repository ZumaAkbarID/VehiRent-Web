
<h1>Thank you for creating an account at {{ config('app.name') }}.</h1>
@if (isset($isMobile))
<p><i>Use the OTP code below to activate the account</i></p>
<br>
<br>
<h2>{{ $token }}</h2>
<br>
<br>
@else
<p><i>Click the link below to activate your account</i></p>
<br>
<br>
<h3>{{ url('/account/verify/'.$token) }}</h3>
<br>
<br>
@endif

<table>
    <tr>
        <td>Date </td>
        <td>: {{ date('D d-M-Y H:i:s', strtotime(now())) }}</td>
    </tr>
    <tr>
        <td>Ip Address </td>
        <td>: {{ $client_ip_address }}</td>
    </tr>
</table>