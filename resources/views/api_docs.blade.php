<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>

    <body>
        <h3>Apps Api Url</h3>

        <ol>
            <li>
                <b>All Doctors: </b>
                <a href="{{ url('/api/doctors') }}" target="_blank">
                    /api/doctors
                </a>
            </li>
            <li>
                <b>All Division: </b>
                <a
                    href="{{ url('/api/divisions') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    /api/divisions
                </a>
            </li>
            <li>
                <b>All District by division id: </b>
                <a
                    href="{{ url('/api/division/1') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    /api/division/1
                </a>
            </li>
            <li>
                <b>All City/Upazila by district Id: </b>
                <a
                    href="{{ url('api/district/1') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    /api/district/1
                </a>
            </li>
            <li>
                <b>Doctor And Hospital by City: </b>
                <a href="{{ url('api/doctor-hospital/1')}}" target="_blank" rel="noopener noreferrer">
                /api/doctor-hospital/1
                </a>
            </li>
            <li>
                <b>Single Hospital: </b>
                <a href="{{ url('api/hospital/1')}}" target="_blank" rel="noopener noreferrer">
                /api/hospital/1
                </a>
            </li>
            <li>
                <b>Single Doctor: </b>
                <a href="{{ url('api/doctor/1')}}" target="_blank" rel="noopener noreferrer">
                /api/doctor/1
                </a>
            </li>
            <li>
                <b>Appoinment</b>
                <a href="{{url('/api/appoinment')}}" target="_blank" rel="noopener noreferrer">
                /api/appoinment
                </a>
            </li>
        </ol>
    </body>
</html>
