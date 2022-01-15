<html>
    <head>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .header {
                font-size: 1.5rem;
                background-color: #fed7aa;
                padding: 0 .5rem;
            }
            table {
                table-layout: fixed;
                width: 100%;
            }
            .cell-header {
                font-weight: bold;
                padding-right: 32px;
            }
            img {
                width: 6rem;
            }
            .image-wrapper {
                text-align: center;
            }
        </style>
    </head>

    <body>
    <div class="image-wrapper">
        <img src="images/logo.jpg" alt="">
    </div>

    <h3 class="header">Beacon information</h3>
    <table>
        <tbody>
        <tr>
            <td class="cell-header">Beacon Hex ID</td>
            <td>{{ $vessel->beacon->uin }}</td>
        </tr>

        <tr>
            <td class="cell-header">Beacon type</td>
            <td>{{ $vessel->beacon->model->type->name }}</td>
        </tr>

        <tr>
            <td class="cell-header">Beacon status</td>
            <td>{{ $vessel->beacon->status->name  }}</td>
        </tr>

        <tr>
            <td class="cell-header">Registration date</td>
            <td>{{ \Carbon\Carbon::parse($vessel->beacon->registration_date)->format('F d, Y')  }}</td>
        </tr>

        <tr>
            <td class="cell-header">Battery expiration date</td>
            <td>{{ \Carbon\Carbon::parse($vessel->beacon->expiration_date)->format('F d, Y')  }}</td>
        </tr>

        <tr>
            <td class="cell-header">Manufacturer</td>
            <td>{{ $vessel->beacon->manufacturer->name  }}</td>
        </tr>

        <tr>
            <td class="cell-header">S/N manufacturer</td>
            <td>{{ $vessel->beacon->serial_number_manufacturer  }}</td>
        </tr>

        <tr>
            <td class="cell-header">S/N SAR</td>
            <td>{{ $vessel->beacon->serial_number_sar  }}</td>
        </tr>

        <tr>
            <td class="cell-header">Model</td>
            <td>{{ $vessel->beacon->model->name  }}</td>
        </tr>

        <tr>
            <td class="cell-header">TAC</td>
            <td>{{ $vessel->beacon->tac  }}</td>
        </tr>

        <tr>
            <td class="cell-header">Updated at</td>
            <td>{{ \Carbon\Carbon::parse($vessel->beacon->updated_at)->format('F d, Y g:i A') }}</td>
        </tr>
        </tbody>
    </table>

    <h3 class="header">Unit information</h3>
    <table>
        <tbody>
        <tr>
            <td class="cell-header">Unit name</td>
            <td>{{ $vessel->name }}</td>
        </tr>
        <tr>
            <td class="cell-header">Activity type</td>
            <td>{{ $vessel->activity->name }}</td>
        </tr>
        <tr>
            <td class="cell-header">Registration number</td>
            <td>{{ $vessel->registration_number }}</td>
        </tr>
        <tr>
            <td class="cell-header">City</td>
            <td>{{ $vessel->port->city->name }}</td>
        </tr>
        <tr>
            <td class="cell-header">Port of registration</td>
            <td>{{ $vessel->port->name }}</td>
        </tr>
        <tr>
            <td class="cell-header">MMSI</td>
            <td>{{ $vessel->mmsi }}</td>
        </tr>
        <tr>
            <td class="cell-header">Updated at</td>
            <td>{{ \Carbon\Carbon::parse($vessel->updated_at)->format('F d, Y g:i A') }}</td>
        </tr>
        </tbody>
    </table>

    <h3 class="header">Owner / Emergency contacts</h3>
    <table>
        <tbody>
        <tr>
            <td class="cell-header">Name</td>
            <td>{{ $vessel->user->name ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Address</td>
            <td>{{ $vessel->user->address ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Phone number</td>
            <td>{{ $vessel->user->phone_number ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Secondary phone number</td>
            <td>{{ $vessel->user->secondary_phone_number ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Email</td>
            <td>{{ $vessel->user->email ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Emergency contact name</td>
            <td>{{ $vessel->user->emergency_contact_name ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Emergency contact phone number</td>
            <td>{{ $vessel->user->emergency_contact_phone_number ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Secondary emergency contact name</td>
            <td>{{ $vessel->user->secondary_emergency_contact_name ?? '' }}</td>
        </tr>
        <tr>
            <td class="cell-header">Secondary emergency contact phone number</td>
            <td>{{ $vessel->user->secondary_emergency_contact_phone_number ?? '' }}</td>
        </tr>

        </tbody>
    </table>
    </body>
</html>
