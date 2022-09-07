<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

 
   protected $fillable = [
       'title', 'subtitle', 'slug','price','priceHT','status','description','quantity','category_id','tva_id','image'
       
   ];

   protected static function boot()
   {
        // Pour le slug
        parent::boot();
        static::creating(function($model){
            $model->slug = Str::slug($model->title);
        });

        // Pour le prixHT
        static::creating(function($model){
            $model->priceHT = ($model->price) / (1 + ($model->tva->value));
        });
    }

    // recupere les produits actifs (en vente)
    public function scopeActif($query)
    {
        return $query->where('status',1)->orderBy('title');
    }

    public function scopePrixHt($query ,$id)
    {
        //return recupere prix du produit 
        return $query->where('id',$id)
            ->value('priceHT');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tva()
    {
        return $this->belongsTo(Tva::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    
    public function isLiked()
    {
        if (auth()->check()) {
            return auth()->user()->likes->contains('id',$this->id);
        }
    }
}
