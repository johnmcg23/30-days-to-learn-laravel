<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';

    protected $guarded = [];

    public function employers() {
        // Define a one-to-many inverse relationship.
        // This model (likely Job) belongs to a single Employer.
        // Laravel will look for an 'employer_id' foreign key on the current model's table.
    
        return $this->belongsTo(Employer::class);
    }    

    public function tag(string $name) {
        $tag = Tag::firstOrCreate(['name' => $name]);

        $this ->tags()->attach($tag);
    }

    public function tags() {
        // Define a many-to-many relationship between Job and Tag models.
        // This assumes the existence of a pivot table (typically 'job_tag') 
        // with 'job_id' and 'tag_id' as foreign keys.
    
        return $this->belongsToMany(Tag::class);
    }

    // An employer can have many jobs
    public function jobs() {
        return $this->hasMany(Job::class); // many-to-one relationship
    }
    
    
}
