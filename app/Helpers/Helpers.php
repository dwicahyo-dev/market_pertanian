<?php

namespace App\Helpers;

class Helpers
{
    public static function setSelected($uriSegment)
    {
        return request()->segment(1) == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSettings($uriSegment)
    {
        return request()->segment(3) == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSegmentSearch($uriSegment)
    {
        return request()->query('st') == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSegmentOne($uriSegment)
    {
        return request()->segment(1) == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSegmentTwo($uriSegment)
    {
        return request()->segment(2) == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSegmentThree($uriSegment)
    {
        return request()->segment(3) == $uriSegment ? 'active' : '';
    }

    public static function setSelectedSegmentStoreFront($id)
    {
        return request()->segment(4) == $id ? 'active' : '';
    }

    public static function ifSegmentTwo($uriSegment)
    {
        if (request()->segment(2) == $uriSegment) return true;
    }

    public static function ifSegmentThree($uriSegment)
    {
        if (request()->segment(3) == $uriSegment) return true;
    }

    public static function showStoreName($product, $discussion)
    {
        if (($product->store_id == isset($discussion->user->store->id)) && ($discussion->user->store->store_name == $product->store->store_name)) {
            return $discussion->user->store->store_name;
        } else {
            return $discussion->user->name;
        }
    }

    public static function showIfSeller($product, $discussion)
    {
        if (($product->store_id == isset($discussion->user->store->id)) && ($discussion->user->store->store_name == $product->store->store_name)) {
            echo "<span class='badge badge-primary'>Penjual</span>";
        }
    }

    public static function totalPrice(int $qty, int $price)
    {
        $price = $qty * $price;
        $output = number_format($price, 0, ',', '.');

        return 'Rp.' . $output;
    }

    public static function invoiceStatusBadge($checkout)
    {
        if ($checkout->transaction_status == 'expired') {
            return 'badge-danger';
        } else if ($checkout->transaction_status == 'failed' || $checkout->transaction_status == 'cancel') {
            return 'badge-danger';
        } else if ($checkout->transaction_status == 'success') {
            return 'badge-success';
        } else if ($checkout->transaction_status == 'pending') {
            return 'badge-warning';
        } else if ($checkout->transaction_status == 'settlement') {
            return 'badge-success';
        } else if ($checkout->transaction_status == 'deny') {
            return 'badge-danger';
        }
    }

    public static function invoiceStatusText($checkout)
    {
        if ($checkout->transaction_status == 'expired') {
            return 'Kedaluwarsa';
        } else if ($checkout->transaction_status == 'failed' || $checkout->transaction_status == 'cancel') {
            return 'Dibatalkan';
        } else if ($checkout->transaction_status == 'success') {
            return 'Berhasil';
        } else if ($checkout->transaction_status == 'pending') {
            return 'Pending, Menunggu pembayaran';
        } else if ($checkout->transaction_status == 'capture') {
            return 'Pending, Menunggu persetujuan dari Bank';
        } else if ($checkout->transaction_status == 'settlement') {
            return 'Selesai';
        } else if ($checkout->transaction_status == 'deny') {
            return 'Ditolak';
        }
    }

    public static function invoicePaymentMethod($checkout)
    {
        if ($checkout->order_detail->payment_type == 'credit_card') {
            return 'Credit Card';
        } else if ($checkout->order_detail->payment_type == 'mandiri_clickpay') {
            return 'Mandiri Clickpay';
        } else if ($checkout->order_detail->payment_type == 'credit_card') {
            return 'Credit Card';
        } else if ($checkout->order_detail->payment_type == 'cimb_clicks') {
            return 'CIMB Clicks';
        } else if ($checkout->order_detail->payment_type == 'bca_klikbca') {
            return 'Click Pay';
        } else if ($checkout->order_detail->payment_type == 'bri_epay') {
            return 'e-Pay BRI';
        } else if ($checkout->order_detail->payment_type == 'echannel') {
            return 'Transfer Virtual Account';
        } else if ($checkout->order_detail->payment_type == 'mandiri_ecash') {
            return 'LINE PAY e-cash | Mandiri e-cash';
        } else if ($checkout->order_detail->payment_type == 'gopay') {
            return 'Go-Pay';
        } else if ($checkout->order_detail->payment_type == 'indomaret') {
            return 'Indomaret';
        } else if ($checkout->order_detail->payment_type == 'danamon_online') {
            return 'Danamon Online Banking';
        } else if ($checkout->order_detail->payment_type == 'akulaku') {
            return 'Akulaku';
        } else if ($checkout->order_detail->payment_type == 'cstore') {
            return 'Convenience Store';
        }
    }

    public static function cardCheckout($invoice)
    {
        if ($invoice->is_arrived == true && $invoice->is_approved == true && ($invoice->order_detail->transaction_status == 'success' || $invoice->order_detail->transaction_status == 'capture' || $invoice->order_detail->transaction_status == 'settlement')) {
            return '';
        } else if ($invoice->is_arrived == false && $invoice->is_approved == false && $invoice->is_rejected == false && ($invoice->order_detail->transaction_status == 'success' || $invoice->order_detail->transaction_status == 'capture' || $invoice->order_detail->transaction_status == 'settlement')) {
            return 'card-warning';
        } else if ($invoice->is_arrived == false && $invoice->is_approved == true && $invoice->is_rejected == false && ($invoice->order_detail->transaction_status == 'success' || $invoice->order_detail->transaction_status == 'capture' || $invoice->order_detail->transaction_status == 'settlement')) {
            return 'card-info';
        } else if ($invoice->is_arrived == false && $invoice->is_approved == false && $invoice->is_rejected == true) {
            return 'card-danger';
        } else if ($invoice->is_arrived == false && $invoice->is_approved == false && $invoice->is_rejected == false && ($invoice->order_detail->transaction_status == 'expired' || $invoice->order_detail->transaction_status == 'failed' || $invoice->order_detail->transaction_status == 'cancel')) {
            return 'card-danger';
        } else if ($invoice->is_arrived == false && $invoice->is_approved == false && $invoice->is_rejected == false && ($invoice->order_detail->transaction_status == 'pending')) {
            return 'card-primary';
        }
    }

    public static function setCardCheckoutStatus($checkout)
    {
        if (
            $checkout->is_approved == FALSE
            && $checkout->is_arrived == FALSE
            && $checkout->is_rejected == FALSE
        ) {
            echo  '<span class="badge badge-warning">Menunggu disetujui Penjual</span>';
            // return $checkout->checkout_processes->last()->checkoutProcess->type;
        } elseif (
            $checkout->is_approved == TRUE
            && $checkout->is_arrived == FALSE
            && $checkout->is_rejected == FALSE
        ) {
            echo  '<span class="badge badge-secondary">Telah disetujui Penjual</span>';
        } elseif (
            $checkout->is_approved == FALSE
            && $checkout->is_arrived == FALSE
            && $checkout->is_rejected == TRUE
        ) {
            echo  '<span class="badge badge-danger">Dibatalkan</span>';
        } else {
            echo '<span class="badge badge-primary ">Selesai</span>';
        }
    }

    public static function cardActivity($type)
    {
        if ($type == 'system') {
            return 'bg-primary';
        }
        if ($type == 'seller') {
            return 'bg-info';
        }
        if ($type == 'approved') {
            return 'bg-primary';
        }
        if ($type == 'rejected') {
            return 'bg-danger';
        }
        if ($type == 'market') {
            return 'bg-warning';
        }
        if ($type == 'arrived') {
            return 'bg-dark';
        }
        if ($type == 'done') {
            return 'bg-primary';
        }
    }

    public static function activityIcon($type)
    {
        if ($type == 'system') {
            echo '<i class="fas fa-cog"></i>';
        }

        if ($type == 'approved' || $type == 'done' || $type == 'arrived') {
            echo '<i class="fas fa-check"></i>';
        }
        if ($type == 'rejected') {
            echo '<i class="fas fa-times"></i>';
        }
        if ($type == 'market') {
            echo '<i class="fas fa-check"></i>';
        }
        if ($type == 'seller') {
            echo '<i class="fas fa-store"></i>';
        }
    }
}
