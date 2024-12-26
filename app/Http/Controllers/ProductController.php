<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        // Ambil semua produk dan pisahkan berdasarkan is_featured
        $featuredProducts = Product::where('is_featured', 1)->get();
        $otherProducts = Product::where('is_featured', 0)->get();
    
        // Gabungkan produk unggulan dan produk biasa
        $products = $featuredProducts->merge($otherProducts);
    
        return view('products.index', compact('products'));
    }    

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image', // Validasi file gambar
            'jenis_produk' => 'required|in:makanan,minuman',
            'status' => 'required|in:available,unavailable', // Validasi status
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Buat data produk baru
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'jenis_produk' => $request->jenis_produk,
            'image' => $imagePath,
            'status' => $request->status, // Simpan status
            'is_featured' => $request->has('is_featured') ? 1 : 0, // Cek checkbox unggulan
        ]);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'jenis_produk' => 'required|in:makanan,minuman',
            'status' => 'required|in:available,unavailable', // Validasi status
        ]);
    
        // Handle file upload jika ada gambar baru
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
    
        // Tentukan nilai is_featured (1 jika di-check, 0 jika tidak)
        $isFeatured = $request->has('is_featured') ? 1 : 0;
    
        // Update produk dengan data baru
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'jenis_produk' => $request->jenis_produk,
            'image' => $imagePath,
            'status' => $request->status,
            'is_featured' => $isFeatured, // Update is_featured
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui!');
    }    

    // Menghapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function makanan()
    {
        // Ambil produk unggulan yang jenisnya 'makanan'
        $featuredMakanan = Product::where('jenis_produk', 'makanan')->where('is_featured', 1)->get();
    
        // Ambil produk non-unggulan yang jenisnya 'makanan'
        $nonFeaturedMakanan = Product::where('jenis_produk', 'makanan')->where('is_featured', 0)->get();
    
        // Gabungkan produk unggulan dan non-unggulan
        $makanan = $featuredMakanan->merge($nonFeaturedMakanan);
    
        // Kirim data ke view
        return view('products.makanan', compact('makanan'));
    }
    
    public function minuman()
    {
        // Ambil produk unggulan yang jenisnya 'minuman'
        $featuredMinuman = Product::where('jenis_produk', 'minuman')->where('is_featured', 1)->get();
    
        // Ambil produk non-unggulan yang jenisnya 'minuman'
        $nonFeaturedMinuman = Product::where('jenis_produk', 'minuman')->where('is_featured', 0)->get();
    
        // Gabungkan produk unggulan dan non-unggulan
        $minuman = $featuredMinuman->merge($nonFeaturedMinuman);
    
        // Kirim data ke view
        return view('products.minuman', compact('minuman'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search'); // Ambil kata kunci pencarian dari input
    
        // Cari produk berdasarkan nama, pisahkan produk unggulan dan non-unggulan
        $featuredProducts = Product::where('name', 'LIKE', '%' . $searchTerm . '%')->where('is_featured', 1)->get();
        $nonFeaturedProducts = Product::where('name', 'LIKE', '%' . $searchTerm . '%')->where('is_featured', 0)->get();
    
        // Gabungkan produk unggulan dan non-unggulan
        $products = $featuredProducts->merge($nonFeaturedProducts);
    
        return view('search-results', compact('products', 'searchTerm'));
    }    
}

