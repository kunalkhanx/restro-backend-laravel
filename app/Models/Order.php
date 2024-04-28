<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function items():BelongsToMany{
        return $this->belongsToMany(Item::class, OrderItem::class)->withPivot(['quantity', 'price']);
    }

    public function table():BelongsTo{
        return $this->belongsTo(Table::class);
    }

    public function payments():HasMany{
        return $this->hasMany(Payment::class);
    }

    public function waiter():BelongsTo{
        return $this->belongsTo(Waiter::class);
    }

    // static function syncPrice(Order $order){
    //     $items = $order->items()->get();
    //     $total = 0;
    //     foreach($items as $item){
    //         $total =  $total + (((int) $item->pivot->amount) * ((int) $item->pivot->quantity));
    //     }
    //     $order->total = $total;
    //     $order->final = $total;
    //     $order->save();
    // }
}
