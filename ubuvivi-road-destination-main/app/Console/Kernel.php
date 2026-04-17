<?php

namespace App\Console;

use App\Models\Payment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Paypack\Paypack;
use Stringable;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(
            function () {
                info("starting");
                $payments = Payment::where("status", "=", "pending")->get();

                if (!$payments->isEmpty()) {
                    $paypack = new Paypack();

                    $paypack->config([
                        'client_id' => env("paypack_client_id"),
                        'client_secret' => env("paypack_client_secret")
                    ]);
                    Log::info($payments);
                    foreach ($payments as $payment) {

                        $paymentInstance = $paypack->Events(["ref" => $payment->transaction_ref]);

                        if (empty($paymentInstance["transactions"])) {
                            $payment->status = "failed";
                            $payment->save();
                        } else {
                            foreach ($paymentInstance["transactions"] as $transaction) {
                                if ("pending" != $transaction["data"]["status"]) {
                                    $payment->status = $transaction["data"]["status"];
                                    $payment->save();
                                }
                            }
                        }
                    }
                }
            }
        )->everyMinute()->name("resolve_payments")
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
