<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'apartment_type_id',
        'name',
        'capacity_adults',
        'capacity_children',
        'size',
        'bathrooms',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function apartment_type()
    {
    return $this->belongsTo(ApartmentType::class);
    }

    public function rooms()
    {
    return $this->hasMany(Room::class);
    }

    public function facilities()
    {
    return $this->belongsToMany(Facility::class);
    }



    public function beds()
    {
      return $this->hasManyThrough(Bed::class, Room::class);
    }

    // ...

    public function bedsList(): Attribute
    {
    $allBeds = $this->beds;
    $bedsByType = $allBeds->groupBy('bed_type.name');
    $bedsList = '';
    if ($bedsByType->count() == 1) {
    $bedsList = $allBeds->count() . ' ' . str($bedsByType->keys()[0])->plural($allBeds->count());
    } else if ($bedsByType->count() > 1) {
    $bedsList = $allBeds->count() . ' ' . str('bed')->plural($allBeds->count());
    $bedsListArray = [];

    foreach ($bedsByType as $bedType => $bed) {
        $bedsListArray[] = $bed->count() . ' ' . str($bedType)->plural($bed->count());
        }
        $bedsList .= ' ('.implode(', ' , $bedsListArray) .')';
        }
        return new Attribute(
        get: fn () => $bedsList
        );
        }






}
