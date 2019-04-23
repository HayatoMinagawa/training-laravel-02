<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Item\StoreRequest;
use App\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::listOfOptions();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $filename = $request->file->store('public/avatar');
        $category = category::find($request->input('category_id'));

        $category->items()->create([
            'name' => $request->input('name'),
            'avatar_filename' => basename($filename),
        ]);

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Item $item)
    {
        $categories = category::listOfOptions();
        return view('items.edit', compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->input('name');
        $category = Category::find($request->input('category_id'));
        $category->items()->save($item);
        return redirect()->route('items.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }

}
