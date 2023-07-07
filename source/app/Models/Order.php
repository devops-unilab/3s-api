<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'description',
        'customer_user_id',
        'attachment', 'campus',
        'division_id',
        'service_id',
        'client_user_id',
        'tag',
        'phone_number', 'division', 'status', 'solution', 'rating', 'email', 'service_at', 'finished_at', 'confirmed_at', 'provider_user_id', 'assigned_user_id', 'place',
        'division_sig_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function messages()
    {
        return $this->hasMany(OrderMessage::class);
    }
    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_user_id');
    }
}
