<!doctype html>
<html lang="en">
<style>
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>
<body>
    <div>
        <p><strong>Your password has been successfully changed. You can login now</strong></p>
        <a href="{{ url('clients/login-form') }}" class="button">
            Login
        </a>
        <br/>

        <p>Thanks!</p>
    </div>
</body>
</html>
