<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Council extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function children()
    {
        return $this->hasMany(Council::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Council::class, 'parent_id');
    }

    protected static function booted()
    {
        static::creating(function ($council) {
            $council->slug = Str::slug($council->name);
        });
    }
}
