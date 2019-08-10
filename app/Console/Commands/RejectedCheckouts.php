<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Checkout;

class RejectedCheckouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reject:checkouts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rejected checkouts when transaction_status is [settlement, success]';

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
            ->where('is_approved', false)
            ->whereHas('order_detail', function ($query) use ($now) {
                $query->whereIn('transaction_status', ['settlement', 'success']);
                $query->whereDay('transaction_force_rejected', '=', $now);
            })
            ->get();

        foreach ($checkouts as $checkout) {
            $checkout->update([
                'is_rejected' => true,
                'rejected_reason' => 'Transaksi ditolak oleh sistem'
            ]);

            $checkout->checkout_processes()->create([
                'checkout_process_id' => 13
            ]);
        }
    }
}
