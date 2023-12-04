<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class BookController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = Book::all();
        return $this->success_resposnes($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = Book::where('name', $request->name)->first();
        if (is_null($obj)) {
            $request["published_at"] =  Carbon::createFromFormat('d/m/Y', $request->published_at);
            $result = Book::create($request->all());
            return $this->success_resposnes($result, 201);
        } else {
            return $this->fiald_resposnes(cood: 300, message: "the book is alaeady exsit");
        }

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $result = Book::find($id);
        if (!is_null($result)) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Book  $book
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, int $id)
    {
        $obj = Book::find($id);

        if (!is_null($obj)) {
            if ($request->has('published_at'))
                $request["published_at"] =  Carbon::createFromFormat('d/m/Y', $request->published_at);
            $result = tap($obj)->update($request->all());
            return $this->success_resposnes($result, 210);
        } else {
            return $this->fiald_resposnes();
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Book  $book
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(int $id)
    {
        $obj = Book::find($id);
        if (!is_null($obj)) {
            $result = tap($obj)->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
