<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: url("{{ public_path('fonts/OpenSans-VariableFont_wdth,wght.ttf') }}") format('truetype');
        }


        body {
            font-family: "Open Sans", sans-serif !important;
        }

        .page-break {
            page-break-after: always;
        }

        img {
            width: 100%;
        }

        table {
            width: 100%;

        }

        .table {

            border-color: gray;
            border-collapse: collapse;
        }

        table tr td,
        table tr th {
            padding: 5px;
        }

        table tr th {
            text-align: left;
        }

        table tr td label {
            font-weight: 300;
            color: gray;
            font-size: 12px;
            display: block;
            margin: 0 !important;

        }

        table.detailstable tr td label {
            margin-left: 15px;
            padding-left: 15px;
        }

        p {
            margin: 0 !important;
            font-size: 13px;
        }

        h5 {
            margin: 0 !important;
        }


        .imgbox img {
            width: 100%;
        }



        .imgbox h4 {
            margin: 4px;
        }

        .imgcontainer tr {
            margin-bottom: 10px;
        }

        .notes p {
            color: grey;
        }

        .notes {
            padding: 10px;
        }

        .notes p span {
            color: black;
            font-weight: bold;
        }

        .iconimg {
            display: inline-block;
            width: 20px;
            position: relative;
            top: 5px;
            left: 0;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            /* Adjust based on the header height */
            left: 10px;

        }

        .pagenum:before {
            content: counter(page);
        }

        .pagenumber {
            position: fixed;
            bottom: -10px;
            /* Adjust based on the header height */
            left: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    @php

        $ratingarr = [
            '1' => [
                'color' => '#a40000', // Dark Red
                'text' => '#fff',
            ],
            '2' => [
                'color' => '#fd5602', // Dark Orange
                'text' => '#000',
            ],
            '3' => [
                'color' => '#fd6902', // Gold
                'text' => '#fff',
            ],
            '4' => [
                'color' => '#fd8b02', // Lime Green
                'text' => 'Very Good',
            ],
            '5' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
            '6' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
            '7' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
            '8' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
            '9' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
            '10' => [
                'color' => '#fda602', // Dark Green
                'text' => 'Excellent',
            ],
        ];
    @endphp
    <table border="0" style="border:1px solid gray;">
        <tr>
            <td style="width:150px;">
                <img width="150" src="{{ url('public/images/logo.png') }}" alt="" style="max-width:100%;">
            </td>
            <td style="text-align: right;">
                <h4>Vehicle Inspection Report</h4>
                <p>
                    Certificate No.: {{ $details['inspection_id'] }}
                </p>
            </td>
        </tr>
    </table>
    <table border="1" class="table">
        <tr>
            <td>
                <h5>{{ $details['select_variant'] }}</h5>
            </td>
        </tr>
    </table>
    <table border="1" class="table">
        <tr>
            <td style="width: 50%">


                <img src="{{ 'https://localhost:7456/' . $details['front_photo'] }}" alt="Default Image">

            </td>

            <td style="width: 50%">
                <table border="0" class="detailstable" style="border-collapse: collapse;width:100%;">
                    <tr>
                        <td style="width: 50%">

                            <p><img src="{{ url('public/images/location.png') }}" class="iconimg" />
                                {{ $details['enter_rto_city'] }}</p>
                            <label for="">RTO</label>
                        </td>
                        <td style="width: 50%">
                            <p><img src="{{ url('public/images/plate.png') }}" class="iconimg" />
                                {{ $details['registration_number'] }}</p>
                            <label for="">Registration No</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <p> <img src="{{ url('public/images/calendar.png') }}" class="iconimg" />
                                {{ $details['manufacture_year'] }}
                            </p>
                            <label for="">Manufacturing Year</label>
                        </td>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/calendar.png') }}" class="iconimg" />
                                {{ $details['date_of_registration'] }}
                            </p>
                            <label for="">Registration Date</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/man.png') }}" class="iconimg" />
                                {{ $details['enter_no_of_owners'] }}
                            </p>
                            <label for="">No of Owners</label>
                        </td>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/odometer.png') }}" class="iconimg" />
                                {{ $details['enter_odometer'] }}
                            </p>
                            <label for="">Odometer Reading </label>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/fuel.png') }}" class="iconimg" />

                                {{ $details['select_fuel_type'] }}
                            </p>
                            <label for="">Fuel Type</label>
                        </td>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/fuel.png') }}" class="iconimg" />
                                {{ $details['transmission_status'] }}
                            </p>
                            <label for="">Transmission</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/color.png') }}" class="iconimg" />
                                {{ $details['enter_vehicle_color'] }}
                            </p>
                            <label for="">Color</label>
                        </td>
                        <td style="width: 50%">
                            <p>
                                <img src="{{ url('public/images/car.png') }}" class="iconimg" />
                                {{ $details['select_body_type'] }}
                            </p>
                            <label for="">Vehicle Type</label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="1" class="table">
        <tbody>
            <tr>
                <td style="width: 25%">
                    <p>{{ $details['engine_number_last_5'] }}</p>
                    <label for="">Engine Number (last Five)</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['chesis_number_last_5'] }}</p>
                    <label for="">Chassis Number (Last Five)</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['owner_name'] }}</p>
                    <label for="">Customer Name</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['original_rc_available'] }}</p>
                    <label for="">Original RC Availabl</label>
                </td>
            </tr>
            <tr>
                <td style="width: 25%">
                    <p>{{ $details['fitness_valid_till'] }}</p>
                    <label for="">Fitness Expire Date</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['tax_valid_till'] }}</p>
                    <label for="">Tax Expire Date</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['insurance_valid_till'] }}</p>
                    <label for="">Insurance Expire Date</label>
                </td>
                <td style="width: 25%">
                    <p>{{ $details['permit_valid_till'] }}</p>
                    <label for="">Permit Expire Date</label>
                </td>
            </tr>

        </tbody>
    </table>
    <table border="1" class="table">
        <tr>
            <td style="width: 25%">
                <p>{{ $details['executive_name'] }}</p>
                <label for="">Executive Name</label>
            </td>
            <td style="width: 75%">
                <p>{{ $details['address'] }}</p>
                <label for="">Location</label>
            </td>
        </tr>
    </table>
    <div style="margin-top:4px;border:1px solid #999999">
        <table border="0" style="border:1px solid #999999;">
            <tr>
                <td>

                </td>
            </tr>




        </table>

        <table border="0">
            <tr>
                <td style="width:25%">
                    <span style="padding:4px 10px;background:#02a207;margin-right:5px;display:inline-block;"></span>
                    <span>Excellent</span>
                </td>
                <td style="width:25%">
                    <span style="padding:4px 10px;background:#b1fd02;margin-right:5px;display:inline-block;"></span>
                    <span>Good</span>
                </td>
                <td style="width:25%">
                    <span style="padding:4px 10px;background:#fd8b02;margin-right:5px;display:inline-block;"></span>
                    <span>Average</span>
                </td>
                <td style="width:25%">
                    <span style="padding:4px 10px;background:#fd0202;margin-right:5px;display:inline-block;"></span>
                    <span>Poor</span>
                </td>
            </tr>
        </table>
    </div>
    <table border="1" class="table">
        <tbody>
            <tr>
                <td style="width:25%">
                    <h5>Remarks</h5>
                </td>
                <td style="width:75%">
                    <p>
                        {{ $details['remark'] }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table border="1" class="table">
        <tbody>
            @foreach ($carimages as $index => $cimage)
                @if ($cimage['image'])
                    @if ($index % 2 == 0)
                        <tr>
                    @endif
                    <td colspan="3">

                        <div class="imgbox">
                            <img style="width:100%;height:300px;object-fit:cover;"
                                src="{{ 'https://localhost:7456/' . $cimage['image'] }}"
                                alt="{{ $cimage['name'] }}">
                            <h4>{{ $cimage['name'] }}</h4>
                        </div>

                    </td>
                    @if ($index % 2 == 1)
                        </tr>
                    @endif
                @endif
            @endforeach

            @if (count($carimages) % 2 != 0)
                </tr>
            @endif
        </tbody>
    </table>
    <table border="1" class="table">
        <tr>
            <td style="width:25%">
                Head Office
            </td>
            <td style="width:75%">
                <h5>Car Expert</h5>
                <p>
                    126, 1st Floor,D Mall Rohini,
                    Sector-10,Delhi- 110085,
                    Near Rohini West Metro Station
                </p>
                <p>
                    <strong> Customer Care No. </strong> 1800-208-9595 | <strong> Website </strong> :
                    www.carexpertindia.com
                </p>
            </td>
        </tr>
    </table>
    <div class="footer">
        <p>Date of Inspection {{ date('d-M-Y') }}</p>

    </div>



</body>

</html>
