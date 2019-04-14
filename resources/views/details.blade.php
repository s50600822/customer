@extends('layouts.app')


@if( empty($customer) )
    <div class="error">Sorry: {{ $error_msg }}</div>
@else
    @section('title', $customer->first_name . "'s Order History")

    @section('content')
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th># of Products</th>
                <th>Total</th>
            </tr>
            @foreach($customer_orders as $order)
                <tr>
                    <td>{{ $order['date'] }}</td>
                    <td>{{ $order['no_of_product'] }}</td>
                    <td>{{ $order['total'] }}</td>
                </tr>
            @endforeach
            </thead>
            <tbody>
            <tr>
                <td colspan="2">Lifetime Value</td>
                <td>${{ $lifetime_value }}</td>
            </tr>
            </tbody>
        </table>
    @endsection
@endif
