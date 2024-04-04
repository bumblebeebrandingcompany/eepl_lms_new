@extends('layouts.admin')
@section('content')
    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-plotdetails">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Aadhar No</th>
                    <th>Pan</th>
                    <th>Phone</th>
                    <th>Secondary Phone</th>
                    <th>Email</th>
                    <th>Secondary Email</th>
                    <th>Discount Value Sqft Based</th>
                    <th>Discount Amount Sqft Based</th>
                    <th>Total Amount</th>
                    <th>value including plc %</th>
                    <th>Amount including plc %</th>
                    <th>Mode of Payment</th>
                    <th>Cheque No</th>
                    <th>Account No</th>
                    <th>DD name</th>
                    <th>DD No</th>
                    <th>Select DD Date</th>
                    <th>DD Bank</th>
                    <th>Credited/Not Credited</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>


                @php
                    $counter = 1;
                @endphp
                @if ($booking)
                    @foreach ($booking as $bookings)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td> {{ $bookings->name }}</td>
                            <td> {{ $bookings->aadhar_no }}</td>
                            <td> {{ $bookings->pan }}</td>
                            <td> {{ $bookings->phone }}</td>
                            <td> {{ $bookings->secondary_phone }}</td>
                            <td> {{ $bookings->email }}</td>
                            <td> {{ $bookings->secondary_email }}</td>
                            <td> {{ $bookings->discount_value_sqft_based }}</td>
                            <td> {{ $bookings->discount_amount_sqft_based }}</td>
                            <td> {{ $bookings->total_amount }}</td>
                            <td> {{ $bookings->discount_value_including_plc }}</td>
                            <td> {{ $bookings->discount_amount_including_plc }}</td>
                            <td>
                                @if ($bookings->payment_mode == 1)
                                    Card
                                @elseif ($bookings->payment_mode == 2)
                                    Cash
                                @elseif ($bookings->payment_mode == 3)
                                    UPI
                                @elseif ($bookings->payment_mode == 4)
                                    Cheque
                                @endif
                            </td>

                            <td> {{ $bookings->cheque_no }}</td>
                            <td> {{ $bookings->account_no }}</td>
                            <td> {{ $bookings->dd_name }}</td>
                            <td> {{ $bookings->dd_no }}</td>
                            <td> {{ $bookings->dd_date }}</td>
                            <td> {{ $bookings->dd_bank }}</td>
                            <td>
                                @if ($bookings->{'credit/not_credit'} == 1)
                                    Credited
                                @else
                                    Not Credited
                                @endif
                            </td>
                            <td>
                                @if ($bookings->{'credit/not_credit'} == 1)
                                    <span class="badge badge-success">Registered</span>
                                @else
                                    <a href="{{ route('admin.booking.booked', $bookings->id) }}"
                                        class="btn btn-info btn-sm">Register</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                @else
                    <p>No bookings found.</p>
                @endif
            </tbody>
        </table>
    @endsection
