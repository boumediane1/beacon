@php use Carbon\Carbon; @endphp
<html>
<head>
    <style>
        .square:before {
            content: '';
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid black;
        }

        .square-full:before {
            background-color: #1e293b;
        }

        body {
            font-family: 'Nunito', sans-serif;
            line-height: 1.5rem;
        }

        .image-wrapper {
            text-align: center;
        }

        img {
            width: 280px;
        }

        .title-wrapper {
            width: 360px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            font-size: 1.3rem;
            color: #ef4444;
            font-weight: bold;
        }

        .box-wrapper {
            border: 1px solid #6b7280;
            padding: 8px;
            border-radius: 0.125rem;
            margin-top: 10px
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

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="image-wrapper">
    <img src="images/royaume-du-maroc.png" alt="">
</div>

<div class="title-wrapper">
    <h1>Formulaire d'enregistrement des balises de détresse 406 MHz</h1>
</div>


<div>
    <span>Type de balise : </span>
    @foreach($types as $type)
        <span @class(['square', 'square-full' => $type['type']['selected']])></span>
        {{ $type['type']['name'] }}
        <span style="visibility: hidden;">_</span>
    @endforeach
</div>

<div class="box-wrapper">
    <div>
        <span class="font-bold">1) Information relatives à la balise 406MHz</span>
        (à remplir obligatoirement) :
    </div>

    <div style="margin-top: 10px;">
        <div>Indentification de la balise - Code HEX ID (les 15 caractères hexadécimaux) :</div>
        <div class="font-bold">{{ $uin }}</div>
    </div>

    <div style="margin-top: 10px">
        <span>Fabricant : </span>
        <span class="font-bold">{{ $vessel->beacon->manufacturer->name ?? '' }}</span>

        <span style="visibility: hidden;">__</span>

        <span>Modèle : </span>
        <span style="white-space: nowrap; font-weight: bold;">{{ $vessel->beacon->model->name ?? '' }}</span>

        <span style="visibility: hidden;">__</span>

        <span style="white-space: nowrap;">S/N fabricant : </span>
        <span class="font-bold">{{ $vessel->beacon->serial_number_manufacturer }}</span>

        <span style="visibility: hidden;">__</span>

        <span>S/N SAR : </span>
        <span class="font-bold">{{ $vessel->beacon->serial_number_sar }}</span>

        <span style="visibility: hidden;">__</span>

        <span>Date d'enregistrement : </span>
        <span class="font-bold">{{ Carbon::parse($vessel->beacon->registration_date)->format('d F Y') }}</span>

        <span style="visibility: hidden;">__</span>

        <span>Date d'expiration : </span>
        <span class="font-bold">{{ Carbon::parse($vessel->beacon->expiration_date)->format('d F Y') }}</span>

        <span style="visibility: hidden;">__</span>

        <span>Status : </span>
        <span class="font-bold">{{ $vessel->beacon->status->name }}</span>

        <span style="visibility: hidden;">__</span>

        <span>TAC : </span>
        <span class="font-bold">{{ $vessel->beacon->tac }}</span>
    </div>
</div>

<div class="box-wrapper">
    <div>
        <span class="font-bold">2) Enregistrement de la balise</span>
        : (à remplir obligatoirement) :
    </div>
    <table>
        @foreach($registration_statuses as $status)
            <tr>
                <td>
                    <span @class(['square', 'square-full' => $status['status']['selected']])></span>
                    {{ $status['status']['name'] }}
                </td>
            </tr>
        @endforeach
    </table>
</div>


<h3 class="header">Unit information</h3>
<table>
    <tbody>
    <tr>
        <td class="cell-header">Unit name</td>
        <td>{{ $vessel->name }}</td>
    </tr>

    <tr>
        <td class="cell-header">Registration number</td>
        <td>{{ $vessel->registration_number }}</td>
    </tr>

    <tr>
        <td class="cell-header">MMSI</td>
        <td>{{ $vessel->mmsi }}</td>
    </tr>

    <tr>
        <td class="cell-header">Activity type</td>
        <td>{{ $vessel->activity->name }}</td>
    </tr>

    <tr>
        <td class="cell-header">Unit type</td>
        <td>{{ $vessel->unitType->name ?? '-' }}</td>
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
        <td class="cell-header">Updated at</td>
        <td>{{ Carbon::parse($vessel->updated_at)->format('F d, Y g:i A') }}</td>
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
