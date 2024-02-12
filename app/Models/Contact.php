<?php

namespace App\Models;

use App\Models\Scopes\AllowedFilterSearch;
use App\Models\Scopes\AllowedSort;
use App\Models\Scopes\SimpleSoftDelete;
use App\Models\Scopes\SimpleSoftDeleteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes, AllowedSort, AllowedFilterSearch;

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'address', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
