<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checkout_id', 'bank', 'card_type', 'bill_key',
        'biller_code', 'finish_redirect_url', 'fraud_status',
        'gross_amount', 'masked_card', 'order_id',
        'payment_type', 'redirect_url', 'pdf_url',
        'status_code', 'status_message', 'transaction_id',
        'transaction_status', 'transaction_time',
        'transaction_expired', 'transaction_force_arrived',
        'transaction_force_rejected'
    ];

    protected $dates = ['transaction_expired', 'transaction_force_arrived', 'transaction_force_rejected'];

    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['transaction_status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['transaction_status'] = 'success';
        self::save();
    }

    /**
     * Set status to Chellenge by Bank
     *
     * @return void
     */
    public function setChallenge()
    {
        $this->attributes['transaction_status'] = 'challenge';
        self::save();
    }

    /**
     * Set status to Settlement
     *
     * @return void
     */
    public function setSettlement()
    {
        $this->attributes['transaction_status'] = 'settlement';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['transaction_status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Denied
     *
     * @return void
     */
    public function setDeny()
    {
        $this->attributes['transaction_status'] = 'deny';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['transaction_status'] = 'expired';
        self::save();
    }
}
