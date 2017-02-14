<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Quote;

class QuoteController extends Controller
{
    public function getIndex()
    {
        return view('index');
    }
    
    public function postQuote(Request $request)
    {
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];
        
        $author = Author::where('name', $authorText)->first();
        if(!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->save();
        }
        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);
        
        return redirect()->route('index')->with([
            'success'   => 'Quote saved'
        ]);
    }
}
