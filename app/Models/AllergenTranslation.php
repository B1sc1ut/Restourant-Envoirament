<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergenTranslation extends Model
{
    public function allergen() {
        return $this->belongsTo(Allergen::class, 'allergen_id');
    }
}
