<?php


namespace App\Http\Controllers\Admin;


use App\Order;
use App\Product;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use App\Http\Controllers\Controller;


class ProductController
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }

    public function show($id) {
        $product = Product::find($id);
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Base des régles
     * @var array
     */
    private $rules = [
        'title'       => 'required|string|max:255',
        'subtitle'    => 'required|string|max:255',
        'price'       => 'numeric|min:0|required',
        'stock'       => 'numeric|min:0|required',
        'description' => 'string',
    ];

    /**
     * Return la vue du form pour ajouté
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return view('admin.products.add');
    }

    /**
     * Retourne la vue pour update
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function formUpdate($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            return view('admin.products.edit')->with('product', $product);
        }
        return redirect()->back();
    }

    /**
     * Valide le formulaire
     * @param Request $request
     * @return array
     */
    private function validate(Request $request)
    {
        return $request->validate($this->rules);
    }

    /**
     * Connection avec la base de données
     * @param Product $product
     * @param Request $request
     */
    private function create(Product $product, Request $request)
    {
        // Upload photo
        $fullFileName = $request->file('photo')->getClientOriginalName();
        $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $file = $fileName . '_' . time() . '.'. $extension;
        // Storage upload
        $request->file('photo')->storeAs('public/products/', $file);


        $product->title       = $request['title'];
        $product->subtitle    = $request['subtitle'];
        $product->description = $request['description'];
        $product->price       = $request['price'];
        $product->stock       = $request['stock'];
        $product->slug        = Str::slug($request['title'], "-");
        $product->image       = $file;

        $product->save();

         foreach($request->input('categories') as $categoryId) {
            $product->categories()->attach([
                $categoryId,
                $product->id
            ]);
        }
    }

    /**
     * Créer un nouveau produit
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request);
        $product = new Product();

        $this->create($product, $request);
        return redirect()->route('admin.products.index')->with('success', 'Votre produit à été ajouté');
        // @see : https://www.google.com/search?q=laravel+flash+alert&oq=laravel+flash+alert&aqs=chrome..69i57j0.3963j0j4&sourceid=chrome&ie=UTF-8
    }

    /**
     * Met a jour le produit
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $slugify = new Slugify();
        $product = Product::find($id);

        // Get all categories ID of the product
        $selectedCategories = [];
        foreach($product->categories as $category) {
            array_push($selectedCategories, $category->id);
        }

        if($request->hasFile('photo')) {
            // Upload photo
            $fullFileName = $request->file('photo')->getClientOriginalName();
            $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $file = $fileName . '_' . time() . '.'. $extension;
            // Storage upload
            $request->file('photo')->storeAs('public/products/', $file);
            $product->image = $file;
            // dd($product);
        }

     
        $product->title = $request->input('title');
        $product->slug = $slugify->slugify($request->input('title'));
        $product->subtitle = $request->input('subtitle');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
  
        $product->save();

        
        if($request->input('categories')) {
            // Remove old categories and attach new categories selected
            $product->categories()->detach($selectedCategories);
            
            foreach($request->input('categories') as $categoryId) {
                $product->categories()->attach([
                    $categoryId,
                    $product->id
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Votre produit à été mis à jours');
    }

     /*public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        dd($data);
        Cart::update($rowId, $data['qty']);

        return view('admin.products.index');
    }
    */
    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
