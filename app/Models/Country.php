<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'created_by', 'created', 'last_modified_by', 'last_modified', 'published'];
    public $timestamps = false;

    public function regions() {
        return $this->hasMany(Region::class, 'country', 'id');
    }
}
