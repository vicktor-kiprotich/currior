@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar mb-3 mt-2 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Checkout') }}</h1>
            </div>

        </div>
    </div>
    @if ($payment->status < 1)
        <div class="card px-2 py-16 text-center">

            <img class="mx-auto pb-10" style="width:200px" src="{{ static_asset('assets/img/cards/mpesa.png') }}"
                alt="">
            <p class="text-center">
                An M-Pesa STK (Push) payment has been sent to the client's phone ({{ $shipment->reciver_phone }}).
            </p>
            <p>
                After they have received the mpesa transaction confirmation message, click the button below to continue.
            </p>

            <form action="{{ route('admin.payment.confirm', $shipment->code) }}" method="POST">

                @csrf
                <input type="hidden" name="checked_ids[]" value="{{ $mission['id'] }}" />
                <button type="submit" class="btn-primary btn mx-auto" style="width: 180px">Confirm payment</button>
            </form>
            <form action="{{ route('checkout-postpaid', ['id' => $shipment->id]) }}" method="get">
                @csrf
                <button type="submit" class="btn-success btn mx-auto mt-8" style="width: 180px">Resend STK push</button>
            </form>
        </div>
    @else
        <div class="card px-2 py-16 text-center">
            <img class="mx-auto pb-10" style="width:200px" src="{{ static_asset('assets/img/cards/tick.png') }}"
                alt="">
            <p class="text-center">
                Payment for {{ $shipment->code }} has already been confirmed.
            </p>
            <form action="{{ route('admin.missions.recived.index', ['status' => '5']) }}" method="get">
                <button type="submit" class="btn-primary btn mx-auto" style="width: 180px">Proceed</button>
            </form>
        </div>
    @endif
@endsection
