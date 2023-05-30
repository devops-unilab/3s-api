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
    protected $fillable = ['id', 'division_id', 'service_id', 'client_user_id', 'description', 'campus', 'tag', 'phone_number', 'division', 'status', 'solution', 'rating', 'email', 'service_at', 'finished_at', 'confirmed_at', 'provider_user_id', 'assigned_user_id', 'attachment', 'place'];

    
}
