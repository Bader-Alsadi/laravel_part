<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Author::all();
        return $this->success_resposnes($result);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $result = Author::create($request->all());
        return $this->success_resposnes($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $result = Author::find($id);
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
    //  * @param  \App\Models\Author  $author
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, int $id)
    {
        $obj = Author::find($id);
        if (!is_null($obj)) {

            $result = tap($obj)->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Author  $author
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(int $id)
    {

        $obj = Author::find($id);
        if (!is_null($obj)) {
            $result = tap($obj)->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
