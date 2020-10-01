<!doctype html>
<html lang="en">

<body>
    <div>
        <p>You have received this email because of a password recovery for the user account "WebMedical" was instigated by you on WebMedical.</p>
        <a href="{{ url('clients/reset-password-form?token='.$token) }}">
            {{ url('clients/reset-password-form?token='.$token) }}
        </a>
        <br/>

        <p>Thanks!</p>
    </div>
</body>
</html>
