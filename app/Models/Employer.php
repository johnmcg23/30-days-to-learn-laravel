<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Define the Employer model, which extends Laravel's base Eloquent Model
class Employer extends Model
{
    // Include the HasFactory trait to enable factory-based creation of Employer instances
    use HasFactory;

    /**
     * Define a one-to-many relationship:
     * An employer can have many jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Define an inverse one-to-one or many relationship:
     * An employer belongs to a user (e.g., account owner or admin).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
