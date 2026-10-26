<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_description',
        'description',
        'thumbnail',
        'tech_stack',
        'demo_url',
        'github_url',
        'client',
        'completed_date',
        'is_featured',
        'order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Get tech stack as array of tags.
     *
     * @return list<string>
     */
    public function getTechTagsAttribute(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }

        return array_map('trim', explode(',', $this->tech_stack));
    }

    /**
     * Get image url or fallback default.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (! empty($this->thumbnail)) {
            if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
                return $this->thumbnail;
            }

            return asset('storage/'.$this->thumbnail);
        }

        return 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
    }
}
