<?php

namespace App\Http\Controllers;

use App\Checkout;
use Illuminate\Http\Request;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Transaction;

use Illuminate\Support\Str;
use App\ShoppingCart;
use App\OrderDetail;
use Carbon\Carbon;

use App\ProductHistory;
use App\Review;
use Illuminate\Support\Facades\Auth;
use App\AddressHistory;
use PDF;

class CheckoutController extends Controller
{
    /**
     * Global variable for limiting transactions
     *
     * @var [private]
     */
    private $forceRejected;
    private $forceArrived;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Guarding any functions to Authenticate user with only chain method
         */
        $this->middleware('auth')->only([
            'edit', 'update', 'destroy', 'paymentInvoices', 'paymentTransactions', 'show',
            'store', 'getSnapToken', 'setCheckoutArrived', 'setCheckoutApproved', 'setCheckoutRejected',
            'review', 'storeReview', 'printInvoice'
        ]);

        /**
         * Set midtrans configurations
         */
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

        /**
         * Defining Global variable to environment
         * 2nd params of env define to default value of keys if are not exist
         */
        $this->forceRejected = env('APP_TRANSACTIONS_FORCE_REJECTED', 3);
        $this->forceArrived = env('APP_TRANSACTIONS_FORCE_ARRIVED', 4);
    }

    /**
     * Display only Payment Invoices
     *
     * @return void
     */
    public function paymentInvoices()
    {
        $checkouts = $this->getInvoices();
        $invoices = $checkouts->latest()->paginate(10);
        $countInvoice = $checkouts->count();

        $transactionsOrigin = $this->getTransactions();
        $countTransactions = $transactionsOrigin->count();

        return view('checkouts.index', compact('invoices', 'countInvoice', 'countTransactions'));
    }

    /**
     * Display only Payment Transactions
     *
     * @return void
     */
    public function paymentTransactions()
    {
        $checkouts = $this->getInvoices();
        $countInvoice = $checkouts->count();

        $transactionsOrigin = $this->getTransactions();
        $invoices = $transactionsOrigin->latest()->paginate(10);

        $countTransactions = $transactionsOrigin->count();

        return view('checkouts.transactions', compact(
            'countInvoice',
            'invoices',
            'countTransactions'
        ));
    }

    /**
     * Get Invoices data that belongs to Authoried user 
     *
     * @return void
     */
    public function getInvoices()
    {
        return Checkout::with([
            'review',
            'product.agriculture.commodity', 'product.store.user',
            'product.store.city', 'user.store.city', 'order_detail', 'address.city'
        ])->where('user_id', auth()->id());
    }

    /**
     * Get Transactions data that specified store
     *
     * @return void
     */
    public function getTransactions()
    {
        return Checkout::with([
            'product.agriculture.commodity', 'product.store.user',
            'product.store.city', 'user.store.city', 'order_detail', 'address.city'
        ])->whereHas('order_detail', function ($query) {
            $query->whereIn('transaction_status', ['settlement', 'capture', 'success']);
        })->whereHas('product.store', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    /**
     * Canceling the specified Transaction 
     *
     * @param [int] $orderId
     * @return boolean
     */
    public function cancelTransaction($orderId)
    {
        try {
            Veritrans_Transaction::cancel($orderId);

            $response = [
                'success' => TRUE,
                'message' => 'Transaksi Telah Dibatalkan'
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => FALSE,
                'message' => 'Transaksi Gagal Dibatalkan'
            ];
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shopping_cart_id = $request->shopping_cart_id;
        $product_real_id = $request->product_real_id;

        $addressHistory = AddressHistory::create([
            'user_id' => Auth::id(),
            'city_id' => $request->city_id,
            'name_of_recipient' => $request->name_of_recipient,
            'phonenumber' => $request->phonenumber,
            'full_address' => $request->full_address,
        ]);

        $productHistory = ProductHistory::create([
            'thumbnail' => $request->thumbnail,
            'product_real_id' => $product_real_id,
            'agriculture_id' => $request->agriculture_id,
            'quality_id' => $request->quality_id,
            'product_name' => $request->product_name,
            'store_id' => $request->store_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        $checkout = Checkout::create([
            'user_id' => auth()->id(),
            'product_id' => $productHistory->id,

            'address_id' => $addressHistory->id,
            'total_price' => $request->total_price,
            'order_id' => $request->order_id,

            'qty' => $request->qty,
            'seller_note' => $request->seller_note,

            'courrier_code' => $request->courrier_code,
            'courrier_name' => $request->courrier_name,
            'service' => $request->service,
            'service_description' => $request->service_description,
            'service_value' => $request->service_value,
            'etd' => $request->etd,
        ]);

        $order_detail = OrderDetail::create([
            'checkout_id' => $checkout->id,
            'approval_code' => $request->approval_code,
            'bank' => $request->bank,
            'card_type' => $request->card_type,
            'bill_key' => $request->bill_key,
            'biller_code' => $request->biller_code,
            'finish_redirect_url' => $request->finish_redirect_url,
            'fraud_status' => $request->fraud_status,
            'gross_amount' => $request->gross_amount,
            'masked_card' => $request->masked_card,
            'order_id' => $request->order_id,
            'payment_type' => $request->payment_type,
            'redirect_url' => $request->redirect_url,
            'pdf_url' => $request->pdf_url,
            'status_code' => $request->status_code,
            'status_message' => $request->status_message,
            'transaction_id' => $request->transaction_id,
            'transaction_status' => $request->transaction_status,
            'transaction_expired' => Carbon::now()->addDay(),
            'transaction_force_arrived' => Carbon::now()->addDay($this->forceArrived),
            'transaction_force_rejected' => Carbon::now()->addDay($this->forceRejected),
            'transaction_time' => $request->transaction_time,
        ]);

        $shopping_cart = ShoppingCart::find($shopping_cart_id);
        $shopping_cart->delete();

        $checkoutStatuses = [
            [
                'checkout_process_id' => 1,
            ],
            [
                'checkout_process_id' => 2,
            ]
        ];

        foreach ($checkoutStatuses as $checkoutStatus) {
            $checkout->checkout_processes()->create([
                'checkout_process_id' => $checkoutStatus['checkout_process_id'],
            ]);
        }

        $response = [
            'success' => TRUE,
            'finish_redirect_url' => route('checkout.show', $checkout->id)
        ];

        return response()->json($response);
    }

    /**
     * Setting stock to specified product
     *
     * @param [obj] $checkout
     * @param [obj] $order_detail
     * @param [obj] $product
     * @return void
     */
    public function setStockProduct($checkout, $order_detail, $product)
    {
        $qty = $checkout->qty;
        $product_stock = $product->stock;

        $total_stock = $product_stock - $qty;

        if ($order_detail->transaction_status == 'settlement' || $order_detail->transaction_status == 'success') {
            if ($product->stock > 0 && $product->product_status == true) {
                $ck = $product->update([
                    'stock' => $total_stock,
                    'product_status' => true
                ]);

                if ($ck == 0) {
                    $product->update([
                        'product_status' => false
                    ]);
                }
            }

            if ($product->stock <= 0 && $product->product_status == true) {
                return $product->update([
                    'stock' => 0,
                    'product_status' => false
                ]);
            }
        }
    }

    /**
     * Get SnapToken to throwing Midtrans's Credentials
     *
     * @return void
     */
    public function getSnapToken()
    {
        $uuid = (string) Str::uuid();
        $amount = request()->amount;
        $customer_name = request()->customer_name;
        $customer_email = request()->customer_email;
        $customer_phone = request()->customer_phone;
        $customer_address = request()->customer_address;
        $product_name = request()->product_name;

        $payload = [
            'transaction_details' => [
                'order_id'      => $uuid,
                'gross_amount'  => $amount,
            ],
            'customer_details' => [
                'first_name'    => $customer_name,
                'email'         => $customer_email,
                'phone'         => $customer_phone,
                'address'       => $customer_address,
            ],
            'item_details' => [
                [
                    'id'       => $product_name,
                    'price'    => $amount,
                    'quantity' => 1,
                    'name'     => $product_name
                ]
            ]
        ];

        $snapToken = Veritrans_Snap::getSnapToken($payload);

        $this->response['snap_token'] = $snapToken;

        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        $this->authorize('view', $checkout);

        return view('checkouts.show', compact('checkout'));
    }

    /**
     * Display the specified resource.
     *
     * @param Checkout $checkout
     * @return void
     */
    public function showTransaction(Checkout $checkout)
    {
        $this->authorize('store', $checkout);

        return view('checkouts.show', compact('checkout'));
    }

    /**
     * Set specified Checkout to Arrived
     *
     * @param Checkout $checkout
     * @return void
     */
    public function setCheckoutArrived(Checkout $checkout)
    {
        $checkout->update([
            'is_approved' => true,
            'is_arrived' => true,
            'is_rejected' => false
        ]);

        $checkoutStatuses = [
            [
                'checkout_process_id' => 6,
            ],
            [
                'checkout_process_id' => 7,
            ]
        ];

        foreach ($checkoutStatuses as $checkoutStatus) {
            $checkout->checkout_processes()->create([
                'checkout_process_id' => $checkoutStatus['checkout_process_id']
            ]);
        }

        $response = [
            'success' => TRUE,
            'message' => 'Barang Berhasil Diterima'
        ];

        return response()->json($response);
    }

    /**
     * Set specified Checkout to Sented
     *
     * @param Checkout $checkout
     * @return void
     */
    public function setCheckoutSented(Checkout $checkout)
    {
        $checkout->update([
            'is_approved' => true,
            'is_arrived' => false,
            'is_sented' => true,
            'is_rejected' => false
        ]);

        $checkout->checkout_processes()->create([
            'checkout_process_id' => 5,
        ]);

        $response = [
            'success' => TRUE,
            'message' => 'Barang Berhasil Dikirim'
        ];

        return response()->json($response);
    }

    /**
     * Set specified Checkout to Approved by the Store
     *
     * @param Checkout $checkout
     * @return void
     */
    public function setCheckoutApproved(Checkout $checkout)
    {
        $product = $checkout->product->productReal;
        $orderDetail = $checkout->order_detail;

        if ($product->stock < $checkout->qty) {
            $response = [
                'success' => FALSE,
                'message' => 'Jumlah Stock Tidak Mencukupi'
            ];
        } else {
            $this->setStockProduct($checkout, $orderDetail, $product);

            $checkout->update([
                'is_approved' => true,
                'is_arrived' => false,
                'is_rejected' => false
            ]);

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 4,
            ]);

            $response = [
                'success' => TRUE,
                'message' => 'Transaksi Berhasil Diterima'
            ];
        }

        return response()->json($response);
    }

    /**
     * Set specified Checkout to Rejected by the Store
     *
     * @param Checkout $checkout
     * @return void
     */
    public function setCheckoutRejected(Checkout $checkout)
    {
        $checkout->update([
            'is_approved' => false,
            'is_arrived' => false,
            'is_rejected' => true,
            'rejected_reason' => request()->rejected_reason
        ]);

        $checkout->checkout_processes()->create([
            'checkout_process_id' => 8,
        ]);

        $response = [
            'success' => TRUE,
            'message' => 'Transaksi Berhasil Ditolak'
        ];

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Checkout $checkout
     * @return void
     */
    public function review(Checkout $checkout)
    {
        $isReview = $checkout->review;

        if ($isReview == !NULL) {
            return redirect()->route('checkout.show', $checkout->id);
        }

        $this->authorize('view', $checkout);

        return view('reviews.create', compact('checkout'));
    }

    /**
     * Rules of Creating Review
     *
     * @return array
     */
    protected function rulesCreateReview()
    {
        return [
            'body_review' => 'required|string',
            'stars' => 'required',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Checkout $checkout
     * @return void
     */
    public function storeReview(Request $request, Checkout $checkout)
    {
        $this->validate($request, $this->rulesCreateReview());

        Review::create([
            'product_id' => $checkout->product_id,
            'checkout_id' => $checkout->id,
            'user_id' => Auth::id(),
            'body_review' => $request->body_review,
            'stars' => $request->stars,
        ]);

        $request->session()->flash('success', 'Berhasil Memberikan Ulasan Produk');

        return redirect()->route('checkout.show', $checkout->product_id);
    }

    /**
     * Print specified resource
     *
     * @param Checkout $checkout
     * @return void
     */
    public function printInvoice(Checkout $checkout)
    {
        $pdf = PDF::loadView('checkouts.print_invoice', compact('checkout'));

        return $pdf->stream('print_invoice_' . $checkout->order_id);
    }
}
