<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categoryId=$request->session()->get('filter_category_id', null);
        $name=$request->session()->get('find_book', null);

        $books=Book::filterByCategory(categoryId:$categoryId)->findByName($name);
        $orders=Order::all();
//        $wishlists=Wishlist::all();

        return view('books.index', [
            'books'=>$books,
            'categories'=>Category::all(),
            'filter_category_id'=>$categoryId,
            'findBook'=>$name,
            'orders'=>$orders,
//            'wishlists'=>$wishlists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {

        return view('books.edit', ['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->fill($request->all());
        $book->save();
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'book'=>$book,
            'categories'=>Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Book $book)
    {
        $book->fill($request->all());
        $book->save();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    public function categoryBooks($id)
    {
        return view('books.index', ['books'=>Book::where('category_id', $id)->get()]);
    }

    public function filterBooks(Request $request){
        $request->session()->put('filter_category_id', $request->category_id);
        return redirect()->route('books.index');
    }

    public function findBooks(Request $request){
        $request->session()->put('find_book', $request->name);
        return redirect()->route('books.index');
    }
}
