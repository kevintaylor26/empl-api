<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketings extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'linkedin_url', 'title', 'company', 'domain', 'city'];
}
