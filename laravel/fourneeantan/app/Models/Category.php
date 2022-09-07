<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Category extends Model
{
    use NodeTrait, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

    public function products()
    {
    return $this->hasMany(Product::class);
    }

    // recupere le nom d'une categorie
    public function scopeNomSsCategory($query,$id)
    {
        return $query->select('name')->where('id',$id)->first();
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
        //return $this->belongsTo(Category::class, 'category_id');
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
        //return $this->hasMany(Category::class, 'category_id');
    }

    
}
