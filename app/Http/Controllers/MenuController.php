<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;


class MenuController extends Controller
{
    //
    public function index()
    {
        $makanan = Menu::where('kategori', 'makanan')->get();
        $minuman = Menu::where('kategori', 'minuman')->get();

        return view('menus.index', compact('makanan', 'minuman'));
    }
    
    public function makanan()
    {
        $makanan = Menu::where('kategori', 'makanan')->get();
        return view('menus.makanan', compact('makanan'));
    }

    public function minuman()
    {
        $minuman = Menu::where('kategori', 'minuman')->get();
        return view('menus.minuman', compact('minuman'));
    }

}
