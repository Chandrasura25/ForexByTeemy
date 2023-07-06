<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $products = Product::with('productType', 'images')->get();
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProductType::all();
        return view('admin.product.create', ['product_types' => $product_types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_types = ProductType::all();
        $request->validate([
            'name' => 'required',
            'product_type_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
            'commission' => 'required',
            'expiration_date' => 'required',
            'images' => 'required|array',
        ]);

        $productData = $request->only([
            'name',
            'product_type_id',
            'quantity',
            'price',
            'description',
            'commission',
            'expiration_date',
        ]);

        $product = Product::create($productData);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploaded = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'products',
                ]);

                $uploadedFile = [
                    'product_id' => $product->id,
                    'file_path' => $uploaded->getSecurePath(),
                    'public_id' => $uploaded->getPublicId(),
                ];

                // Determine the file type based on MIME type
                $fileType = $file->getClientMimeType();
                if (str_contains($fileType, 'image')) {
                    $uploadedFile['file_type'] = 'image';
                } elseif (str_contains($fileType, 'video')) {
                    $uploadedFile['file_type'] = 'video';
                } elseif (str_contains($fileType, 'audio')) {
                    $uploadedFile['file_type'] = 'audio';
                }

                $uploadedImages[] = $uploadedFile;
            }

            // Save the uploaded file details to the database
            Image::insert($uploadedImages);
        }

        // Save the uploaded image details to the "images" table
        if ($product) {
            flash('Product created successfully!')->success();
            return redirect()->route('product.create')->with('product_types', $product_types);

        } else {
            flash('Product creation failed!')->error();
            return redirect()->route('product.create')->with('product_types', $product_types);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('productType', 'images')->find($id);
        return view('admin.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('productType', 'images')->find($id);
        $product_types = ProductType::all();
        return view('admin.product.edit', ['product' => $product, 'product_types' => $product_types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            // Delete associated images
            $product->images()->delete();

            // Delete the product
            $product->delete();
            flash('Product and associated images deleted successfully!')->success();
            return redirect()->route('admin.product.index');
        } else {
            flash('Product not found!')->error();
            return redirect()->route('admin.product.index');
        }
    }

}
