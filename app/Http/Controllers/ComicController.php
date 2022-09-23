<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Http\Requests\StoreComicRequest;
use App\Http\Requests\UpdateComicRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ComicController extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comics = Comic::all();
        return $comics;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreComicRequest  $request
     * @return Comic
     */
    public function store(StoreComicRequest $request)
    {
//        $img = $request->file('img')->store('public/comics');
//        $img = Storage::disk('public')->put('comics', $request->file('img'));
//        $imgUrl = URL::to(Storage::url($img));
//        return $imgUrl;
//        $comic = Comic::create([
//            'name' => $request->input('name')
//        ]);
//
//        return $comic;

    }

    /**
     * Display the specified resource.
     *
     * @param  Comic  $comic
     * @return Comic
     */
    public function show(Comic $comic)
    {
        return $comic;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Comic  $comic
     * @return Response
     */
    public function edit(Comic $comic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateComicRequest  $request
     * @param  Comic  $comic
     * @return Response
     */
    public function update(UpdateComicRequest $request, Comic $comic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comic  $comic
     * @return JsonResponse
     */
    public function destroy(Comic $comic)
    {
        $result = $comic->delete();
        return \response()->json(['result' => $result]);
    }
}
