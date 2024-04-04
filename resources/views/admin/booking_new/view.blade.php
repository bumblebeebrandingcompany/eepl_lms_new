@extends('layouts.admin')
@section('content')
    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-plotdetails">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Team</th>
                    <th>Plot No</th>
                    <th>
                        Sqft
                    </th>
                    <th>Customer Name</th>
                    {{-- <th>Aadhar No</th>
                    <th>Pan</th>
                    <th>Phone</th>
                    <th>Secondary Phone</th>
                    <th>Email</th>
                    <th>Secondary Email</th> --}}
                    <th>Remarks</th>
                    <th>Total Amount Paid</th>
                    {{-- <th>Discount Value Sqft Based</th>
                    <th>Discount Amount Sqft Based</th> --}}
                    <th>Total Plot Cost</th>
                    <th>Balance Due</th>
                    <th>% of payment</th>
                    {{-- <th>value including plc %</th>
                    <th>Amount including plc %</th>
                    <th>Mode of Payment</th>
                    <th>Cheque No</th>
                    <th>Account No</th>
                    <th>DD name</th>
                    <th>DD No</th>
                    <th>Select DD Date</th>
                    <th>DD Bank</th> --}}
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
                            <td> {{ $bookings->user_type }}</td>
                            <td> {{ $bookings->plot->plot_no }}</td>
                            <td> {{ $bookings->plot->total_sqfts }}</td>
                            <td> {{ $bookings->name }}</td>
                            {{-- <td> {{ $bookings->aadhar_no }}</td>
                            <td> {{ $bookings->pan }}</td>
                            <td> {{ $bookings->phone }}</td>
                            <td> {{ $bookings->secondary_phone }}</td>
                            <td> {{ $bookings->email }}</td>
                            <td> {{ $bookings->secondary_email }}</td> --}}
                            <td> {{ $bookings->remarks }}</td>
                            <td>
                                <?php
                                // Convert the string representation of an array to an actual array
                                $advance_amounts = json_decode($bookings->advance_amount, true);
                            
                                // Check if $advance_amounts is an array
                                if (is_array($advance_amounts)) {
                                    // Calculate the sum of the array values
                                    $total_advance_amount = array_sum($advance_amounts);
                                    echo $total_advance_amount;
                                } else {
                                    echo "Invalid data"; // Error message if $bookings->advance_amount is not a valid array
                                }
                                ?>
                            </td>
                           
                            {{-- <td> {{ $bookings->discount_value_sqft_based }}</td>
                            <td> {{ $bookings->discount_amount_sqft_based }}</td> --}}
                            <td> {{ $bookings->total_amount }}</td>
                            <td> {{ $bookings->pending_amount }}</td>
                            {{-- <td> {{ $bookings->discount_value_including_plc }}</td>
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
                            <td> {{ $bookings->dd_bank }}</td> --}}
                             <td>  <?php
                                // Convert the string representation of an array to an actual array
                                $advance_amounts = json_decode($bookings->advance_amount, true);
                            
                                // Check if $advance_amounts is an array
                                if (is_array($advance_amounts)) {
                                    // Calculate the sum of the array values
                                    $total_advance_amount = array_sum($advance_amounts);
                                    $total_advance_amount*100;
                                } else {
                                    echo "Invalid data"; // Error message if $bookings->advance_amount is not a valid array
                                }
                                ?></td>
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
