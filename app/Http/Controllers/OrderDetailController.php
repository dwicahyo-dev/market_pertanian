<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;

use Veritrans_Config;
use Veritrans_Notification;
use App\Checkout;

class OrderDetailController extends Controller
{
    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $orderDetail = OrderDetail::where('order_id', $orderId)->get()->first();
        $checkout = Checkout::where('order_id', $orderId)->get()->first();

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $orderDetail->setChallenge();
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $orderDetail->setSuccess();

                    $checkout->checkout_processes()->create([
                        'checkout_process_id' => 3,
                    ]);
                }
            }
        } elseif ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $orderDetail->setSettlement();

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 3,
            ]);
        } elseif ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $orderDetail->setPending();
        } elseif ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Failed'
            $orderDetail->setDeny();

            $this->setCheckoutRejected($checkout);

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 9
            ]);
        } elseif ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $orderDetail->setExpired();

            $this->setCheckoutRejected($checkout);

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 10,
            ]);
        } elseif ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Failed'
            $orderDetail->setFailed();

            $this->setCheckoutRejected($checkout);

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 11,
            ]);
        }
    }

    public function setCheckoutRejected($checkout)
    {
        $checkout->update([
            'is_approved' => false,
            'is_arrived' => false,
            'is_rejected' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
