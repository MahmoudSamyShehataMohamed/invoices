<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
     // protected $table = 'products';
    // protected $fillable = ['product_name','section_id','description'];
    // protected $timestamps = true;
    // public $hidden = ['','',''];

    public function section()
    {
        return $this -> belongsTo('App\Models\Section','section_id','id');//the only forign key ---- primary key for the first table
    }
}
