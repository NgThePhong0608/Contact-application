<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'address',
        'email',
        'website'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
