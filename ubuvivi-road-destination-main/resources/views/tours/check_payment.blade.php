@extends("layouts.guest")
@section('title')
   Check Payment - Ubuvivi
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
        }

    </style>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section class="px-4 py-5 clearfix">
        @if ($error)
            <div class="container py-5 mb-4">
                <div class="row justify-content-center flex-column align-items-center ">
                    <h3 class="text-center font-primary mb-3">An Error Occured!</h3>
                    <h5 class="text-center mb-5 font-primary font-weight-bold">
                        {{ $message }}
                    </h5>
                </div>
            </div>
        @else
            <div class="container mb-4">
                <div class="row justify-content-center flex-column align-items-center ">
                    @if ($payment->status == 'successful')
                        <i class="fa fa-check-circle text-success fa-5x mb-4"></i>
                        <h3 class="text-center text-success mb-3">Success</h3>
                        <h5 class="text-center mb-5 font-primary font-weight-bold">Payment Received</h5>

                    @else
                        @if ($payment->status == 'pending')
                            <i class="fa fa-check-circle text-warning fa-5x mb-4"></i>
                            <h3 class="text-center text-warning mb-3">Pending</h3>
                            <h5 class="text-center mb-4 font-primary font-weight-bold">Waiting for Payment</h5>
                            <h5 class="font-primary mb-3">
                                Make sure to check a popup on your phone to verify this payment
                            </h5>
                            <h5 class="font-primary mb-4">
                                In case there is no popup dial *182*7*1#
                            </h5>
                            <a href="javascript:location.reload()" style="width: 150px"
                                class="btn btn-primary mb-5">Refresh</a>
                        @else
                            <i class="fa fa-check-circle text-danger fa-5x mb-4"></i>
                            <h3 class="text-center text-danger mb-3">Failed</h3>
                            <h5 class="text-center mb-4 font-primary font-weight-bold">Payment Failed, Please try again</h5>
                            <a href="javascript:history.back()" style="width: 150px" class="btn btn-primary mb-5">Back</a>
                        @endif
                    @endif
                </div>
            </div>
        @endif

    </section>
@endsection
