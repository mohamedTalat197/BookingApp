<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Http\Resources\ApartmentSearchResource;






class ApartmentController extends Controller
{
    public function __invoke(Apartment $apartment)
    {
        $apartment->load('facilities.category');
        return new ApartmentSearchResource($apartment);
    }
}
