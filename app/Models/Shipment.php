<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    /**
    * The model's default values for attributes.
    *
    * @var array
    */
    protected $attributes = [
        
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'shipment_type_id',
        'quantity',
        'product_id',
        'total_price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       
    ];
    //We don't need the created_at/updated_at columns
    public $timestamps = false;

    
    public function shipment_type()
    {
        return $this->belongsTo(ShipmentTypes::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
