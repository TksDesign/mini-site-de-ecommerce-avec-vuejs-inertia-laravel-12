<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\ListingFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'tags',
        'email',
        'link',
        'image',
        'approved',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search']) && is_string($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('desc', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['user_id']) && is_numeric($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        if(!empty($filters['tag'])){
            $query->where('tags', 'like','%' . $filters['tag'] . '%');
        }
    }
}
