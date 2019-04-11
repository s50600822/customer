@extends('layouts.app')

@section('title', $customer->first_name . "'s Order History")

@section('content')
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th># of Products</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- Details go here --}}
            <tr>
                <td colspan="2">Lifetime Value</td>
                <td>${{ $lifeTimeValue }}</td>
            </tr>
        </tbody>
    </table>
@endsection
