<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'existing_client',
        'contact_name',
        'phone',
        'fax_number',
        'email',
        'notification_type',
        'commodity',
        'origin_place',
        'origin_port',
        'destination',
        'mode',
        'inco_terms',
        'weight_kg',
        'weight_cubic_meter',
        'size',
        'comments'
    ];
}
