<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';

    protected $table = 'clients';

    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'start_validity',
        'end_validity',
        'status'
    ];

    protected $casts = [
        'client_name' => 'string',
        'address1' => 'string',
        'address2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'phone_no1' => 'string',
        'phone_no2' => 'string',
        'zip' => 'string',
        'start_validity' => 'datetime',
        'end_validity' => 'datetime',
        'status' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'client_id', 'id');
    }
}
