<!doctype html>
<html lang="en">

<body>
    <div>
        <p>Dear {{ $client->name }},</p>
        <p>Your account has been created. Please click the following link to active your account:</p>
        <a href="{{ route('clients.verification', $client->email_verification_token) }}">
            {{ route('clients.verification', $client->email_verification_token) }}
        </a>
        <br/>

        <p>Thanks!</p>
    </div>
</body>
</html>
