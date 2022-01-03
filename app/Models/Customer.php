<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['fName', 'name'];



    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'like', '%'.$name.'%');
        }

        return $query;
    }

    public function scopeFname($query, $fname)
    {
        if (!is_null($fname)) {
            return $query->where('Fname', 'like', '%'.$fname.'%');
        }

        return $query;
    }

    public function scopeTest($query)
    {
      
            return $query->where('name', 'like', 'Green');
        

       // return $query;
    }
   
}
