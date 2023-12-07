<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            return $this->success_resposnes($result);
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
            return $this->success_resposnes([
                'book' => $result,
                "authors" => $result->authors
            ]);
        } else {
            return $this->fiald_resposnes();
        }
    }

    public function indexCategory(int $id)
    {

        $obj = Book::find($id);
        if (!is_null($obj)) {
            $result = $obj->category;
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
    public function addAuthors(int $id, String $ids)
    {
        $IDs = json_decode($ids);
        $result = Book::find($id);
        if (!is_null($result)) {
            $result = $result->authors()->attach($IDs);
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    public function updateAuthors(int $id, String $ids)
    {
        $IDs = json_decode($ids);
        $result = Book::find($id);
        if (!is_null($result)) {
            $result = $result->authors()->sync($IDs);
            if ($result)
                return $this->success_resposnes($result);
            else return $this->fiald_resposnes();
        } else {
            return $this->fiald_resposnes();
        }
    }

    public function deleteAuthors(int $id, String $ids)
    {
        $IDs = json_decode($ids);
        $result = Book::find($id);
        if (!is_null($result)) {
            $result = $result->authors()->detach($IDs);
            if ($result)
                return $this->success_resposnes($result);
            else return $this->fiald_resposnes();
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

    function rules(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:books',
                'publish_at' => 'required|date_format:d/m/Y|before:' . Carbon::now()

            ]
        );
    }
}
