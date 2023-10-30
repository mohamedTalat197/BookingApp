<?php

namespace App\Http\Controllers\Public;

use App\Http\Resources\PropertySearchResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;



class PropertySearchController extends Controller
{

    public function __invoke(Request $request)
    {
        $properties =  Property::query()
        ->with([
        'city',
        'apartments.apartment_type',
        'apartments.rooms.beds.bed_type'
        ])

    ->when($request->city_id, function($query) use ($request) {
    $query->where('city_id', $request->city_id);
    })

    ->when($request->country_id, function($query) use ($request) {
        $query->whereHas('city' , fn($q) => $q->where('country_id',$request->country_id));

    })

    ->when($request->adults && $request->children, function($query) use ($request) {
        $query->withWhereHas('apartments', function($query) use ($request) {
        $query->where('capacity_adults', '>=', $request->adults)
        ->where('capacity_children', '>=', $request->children)
        ->orderBy('capacity_adults')
        ->orderBy('capacity_children')
        ->take(1);

        });

    })
    ->get();

    return PropertySearchResource::collection($properties);

    }


}
