<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'title',
        'tagline',
        'bio',
        'about_details',
        'avatar',
        'email',
        'phone',
        'location',
        'resume_url',
        'github_url',
        'linkedin_url',
        'instagram_url',
        'years_of_experience',
        'completed_projects',
        'satisfied_clients',
    ];

    /**
     * Get avatar url or fallback default.
     */
    public function getAvatarUrlAttribute(): string
    {
        if (! empty($this->avatar)) {
            if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
                return $this->avatar;
            }

            return asset('storage/'.$this->avatar);
        }

        return 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80';
    }
}
