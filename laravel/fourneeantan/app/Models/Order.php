<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client',
        'city',
        'total',
        'totalHT',
        'item_count',
        'is_paid',
        'status',
        'payment_method',
        'informations',
        'date_retrait',
        'heure_retrait'
    ];
    
    // recupere les commandes ternminées
    public function scopeFinish($query)
    {
        return $query->where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC');
    }
    
    public function scopeFinishAll($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    // recupere les commandes ternminées
    public function scopeWait($query)
    {
        return $query->where('status','En cours')->orderBy('created_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(
            'quantity',
            'price'
            );
    }
}
