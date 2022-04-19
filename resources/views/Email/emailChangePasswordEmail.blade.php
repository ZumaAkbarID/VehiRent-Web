<h1>Your password has been changed.</h1>
<p><i>If you tidak merasa mengganti, lakukan reset password now!</i> <a href="{{ url('/reset-password') }}" target="_blank" rel="noopener noreferrer">Reset Password Here</a></p>

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