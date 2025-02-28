<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasProfilePhoto, HasRoles;

   // protected $with = ['roles.permissions']; // 🔹 Cargar roles y permisos   automáticamente

   protected $appends = ['all_permissions', 'profile_photo_url'];  // ✅ Lista combinada


   public function getAllPermissionsAttribute()
   {
       return $this->getAllPermissions();
   }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'paterno',
        // 'materno',
        // 'nombre',
        'email',
        'password',
        'profile_photo_path',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    // /**
    //  * The accessors to append to the model's array form.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

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

     /**
     * Retorna la URL de la imagen de perfil en AdminLTE
     */
    public function adminlte_profile_url()
    {
        return url('user/profile');
    }

    /**
     * Retorna la descripción del usuario (Ejemplo: Rol del usuario)
     */
    public function adminlte_desc()
    {
        return implode(', ', $this->getRoleNames()->toArray());
    }


    /**
     * Retorna la URL de la página de perfil
     */
    public function adminlte_profile_link()
    {
        // return route('profile.show');
        return url('user/profile');
    }
    public function adminlte_image()
    {
       // return $this->profile_photo_url;
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name);
    }

}
