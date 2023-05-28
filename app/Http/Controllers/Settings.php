<?php

namespace App\Http\Controllers;

use App\Models\PreferenceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Settings extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $filters = PreferenceFilter::where('user_id', $user->id)->get();
        if (count($filters) > 0) {
            $preferenceFilter = PreferenceFilter::findOrFail($filters[0]['id']);
            $preferenceFilter->search = $request->input('search');
            $preferenceFilter->category = $request->input('category');
            $preferenceFilter->source = $request->input('source');
            $preferenceFilter->start_date = $request->input('start_date');
            $preferenceFilter->end_date = $request->input('end_date');
            $preferenceFilter->save();

            return response()->json(['message' => 'Preference filter updated successfully', 'filter' => $preferenceFilter]);
        } else {
            $preferenceFilter = PreferenceFilter::create([
                'search' => $request->input('search'),
                'category' => $request->input('category'),
                'source' => $request->input('source'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'user_id' => auth()->user()->id,
            ]);

            return response()->json(['message' => 'Preference filter added successfully', 'filter' => $preferenceFilter]);
        }

    }


    public function delete(Request $request)
    {
        $user = Auth::user();
        PreferenceFilter::where('user_id', $user->id)->delete();
        return 'done';
    }
    public function getMySearch(Request $request)
    {
        $user = Auth::user();
        $filters = PreferenceFilter::where('user_id', $user->id)->get();

        return $filters;
    }

}