<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemSearchController extends Controller
{


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function index(Request $request)
    {
        if ($request->has('titlesearch')) {
            $items = Item::search($request->titlesearch)->paginate(6);
        } else {
            $items = Item::paginate(6);
        }
        return view('item-search', compact('items'));
    }


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function create(Request $request)
    {
        $this->validate($request, ['title' => 'required']);


        $items = Item::create($request->all());
        return back();
    }
}
