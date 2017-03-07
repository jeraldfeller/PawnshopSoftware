<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Customer Form -->
        <form action="{{ url('customer') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Customer Name -->
            <div class="form-group">
                <label for="customer" class="col-sm-12 control-label">Customer</label>

                <div class="col-sm-12">
                    <input type="text" name="phoneId" id="customer-phone-id" placeholder="Phone ID" class="form-control">
                </div>

                <div class="col-sm-12">
                    <input type="text" name="firstName" id="customer-first-name" placeholder="First Name" class="form-control">
                </div>
                <div class="col-sm-12">
                    <input type="text" name="lastName" id="customer-last-name" placeholder="Last Name" class="form-control">
                </div>
                <div class="col-sm-12">
                Balance Owed:
                </div>
                <div class="col-sm-12">
                    <input type="number" name="currentBalance" id="customer-current-balance" min="0" step="any" class="form-control">
                </div>
                <div class="col-sm-6">
                    <label><input type="checkbox" name="isBillPastDue" id="customer-bill-past-due" value="1" class="form-control">Bill is overdue</label>
                </div>
            </div>

            <!-- Add Customer Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Customer
                    </button>
                </div>
            </div>
        </form>
        <!-- Current Customers -->
        @if (count($customers) > 0)
            <div class="panel panel-default">
            <div class="panel-heading">
                Current Customers
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Customer ID</th>
                        <th>Balance owed</th>
                        <th>Bill past due?</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <form action="{{ url('customer', $customer->phoneId) }}" method="POST">
                                <input name="_method" type="hidden" value="PUT"/>
                                {{ csrf_field() }}
                                    <td class="table-text">
                                        <div>{{ $customer->phoneId }}</div>
                                    </td>
                                    <td>
                                        <div><input name="currentBalance" class="form-control" value="{{ $customer->currentBalance }}"></div>
                                    </td>
                                    <td>
                                        <div><input type="checkbox" name="isBillPastDue" value="1" class="form-control" <?php if ($customer->isBillPastDue == 1) echo 'checked'; ?>/></div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-default"><div></div>Save</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
</html>
