<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'specialite',
        'degree',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public function hasRole($roleId): bool
    // {
    //     return $this->hasAnyRole([$roleId]);
    // }

    public function hasRole($role): bool
    {
        // Cas où on passe un identifiant numérique
        if (is_int($role)) {
            // On considère ici que "4" est utilisé comme identifiant virtuel pour "étudiant doctorant"
            if ($role === 4) {
                return $this->hasVirtualRole('etudiant_doctorant');
            }
            return $this->role_id === $role;
        }

        // Cas où on passe un nom de rôle (chaîne de caractères)
        return $this->hasVirtualRole($role);
    }


    public function hasVirtualRole($virtualRole): bool
    {
        return match ($virtualRole) {
            'etudiant_doctorant' => $this->role_id == 2 &&
                !empty($this->degree) &&
                strcasecmp($this->degree, 'doctorat') === 0,
            default => false,
        };
    }



    // public function hasAnyRole(array $roleIds): bool
    // {
    //     // Rôles simples (role_id dans tableau)
    //     if (in_array($this->role_id, $roleIds)) {
    //         return true;
    //     }

    //     // Cas spécial : rôle 4 = étudiant doctorant
    //     if (in_array(4, $roleIds)) {
    //         // On suppose que le rôle "Étudiant" a role_id = 2 par exemple
    //         if ($this->role_id == 2 && strtolower($this->degree) === 'doctorat') {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    // Vérifie si l'utilisateur possède au moins un des rôles passés dans le tableau
    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }


    public function isDoctorant(): bool
    {
        return $this->role_id == 3 && strcasecmp($this->degree, 'doctorat') === 0;
    }


    public function hasAccessToPresentation(): bool
    {
        return $this->hasRole(1) || $this->hasRole(2) || $this->isDoctorant();
    }






    public function presentations()
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
