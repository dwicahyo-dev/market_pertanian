<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Review;
use App\Checkout;
use Carbon\Carbon;

class ArrivedCheckouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkouts:arrived';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arrived Checkouts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now()->format('d');

        $checkouts = Checkout::with(['order_detail'])
            ->where('is_approved', true)
            ->where('is_arrived', false)
            ->whereHas('order_detail', function ($query) use ($now) {
                $query->whereIn('transaction_status', ['settlement', 'success']);
                $query->whereDay('transaction_force_arrived', '=', $now);
            })
            ->get();

        foreach ($checkouts as $checkout) {
            $checkout->update([
                'is_arrived' => true,
            ]);

            $isReview = $checkout->review;

            if ($isReview == NULL) {
                Review::create([
                    'product_id' => $checkout->product->product_real_id,
                    'checkout_id' => $checkout->id,
                    'user_id' => $checkout->user_id,
                    'body_review' => 'Review otomatis oleh Sistem',
                    'stars' => 5
                ]);
            }

            $checkoutStatuses = [
                [
                    'checkout_process_id' => 12,
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
        }
    }
}
