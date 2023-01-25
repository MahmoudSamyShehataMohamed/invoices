<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table  = 'sections';
    protected $fillable = ['section_name','description','created_by'];

    public function products()
    {
        return $this -> hasMany('App\Models\Product','section_id','id');//the only forign key هو فوريجن كى واحد بيتحط فى كل حته---- primary key for the first table
    }
}
