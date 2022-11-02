<?php

namespace App\Http\Controllers;

use App\Models\CategoryFilm;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;




class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //    return Film::all();
        return Film::with('categories')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required',
            'year' => 'required',
            'plot' => 'required',
            'director' => 'required',
            'rating' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,svg|max:2048'

        ]);
            $film = new Film([
                'title' => $request->title,
                'year' => $request->year,
                'plot' => $request->plot,
                'director' => $request->director,
                'rating' => $request->rating,
                "image" => $request->file('image')->store('images', 'public')

            ]);
            $film->save();
        // }

        return redirect()->route('home')
            ->with('success', 'film created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('crud.show')->with('film',$film);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        return view('crud.edit')->with('film',$film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
      
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'plot' => 'required',
            'director' => 'required',
            'rating' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,svg|max:2048'
        ]);
        $film->update([
            'title' => $request->title,
            'year' => $request->year,
            'plot' => $request->plot,
            'director' => $request->director,
            'rating' => $request->rating,
            "image" => $request->file('image')->store('images', 'public')
        ]);
        return redirect('/home')->with('success','film updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
      
        $film->categories()->detach();
        // $film->users()->detach();
        $film->delete();

    }
}
