<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LibraryCatalog;

class LibraryController extends Controller
{
    protected LibraryCatalog $catalog;

    public function __construct(LibraryCatalog $catalog)
    {
        $this->catalog = $catalog;
    }

    public function index()
    {
        return response()->json($this->catalog->getAll());
    }

    public function search(Request $req)
    {
        $q = $req->query('q','');
        return response()->json($this->catalog->search($q));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'=>'required|string',
            'author'=>'required|string',
            'isbn'=>'required|string',
            'published_year'=>'nullable|integer',
            'copies_total'=>'nullable|integer'
        ]);
        $data['copies_available'] = $data['copies_total'] ?? 1;
        $book = $this->catalog->addBook($data);
        return response()->json($book);
    }

    public function destroy($isbn)
    {
        $ok = $this->catalog->deleteByIsbn($isbn);
        return response()->json(['deleted'=>$ok]);
    }
}
