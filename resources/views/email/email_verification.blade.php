<!DOCTYPE html>
<html lang="en">

<body>
    <h4>Hello, {{$hospital->username}} </h4>
    <p>Email: {{$hospital->email}}</p>
    <p>Please click the following link to verified your email:</p>
    <a href="{{ route('hospital.email.verify', $hospital->email_verification_token)}}">Verify</a>

    <br>
    <p>or copy the link</p>
    <span>{{ route('hospital.email.verify', $hospital->email_verification_token)}}</span>
    <p>Thanks</p>
</body>
</html>

