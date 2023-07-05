<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

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
    protected $fillable = ['name', 'description', 'sla', 'role', 'division_id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
