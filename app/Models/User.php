<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'approved' => false,
    ];

    public function permissions(): belongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeAdmin($query): Builder
    {
        return User::query()
            ->whereRelation('permissions', 'name', 'admin');
    }

    public function isAdmin(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'admin';
        });
    }

    public function canViewFiles(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_view_files';
        });
    }

    public function canViewInvestors(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_view_investors';
        });
    }

    public function canCreateEntity(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_create_entity';
        });
    }

    public function canCreateEvent(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_create_event';
        });
    }

    public function canCreateAccount(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_create_account';
        });
    }

    public function canUpdatePortfolios(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_update_portfolios';
        });
    }

    public function canSeePortfolioPerformance(): bool
    {
        return $this->permissions->contains(function ($value) {
            return $value->name == 'can_see_portfolio_performance';
        });
    }
}
