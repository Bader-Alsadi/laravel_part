<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Category::all();
        if (isEmpty($result)) {
            return $this->success_resposnes($result);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $valdition = $this->rules($request);
        // if ($valdition->fails()) {
        //     return $this->fiald_resposnes($valdition->errors());
        // } else {
        $result = Category::create($request->all());
        if ($request) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $obj = Category::find($id);
        if (!is_null($obj)) {
            return $this->success_resposnes($obj);
        } else {
            return $this->fiald_resposnes();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $obj = Category::find($id);
        if (!is_null($obj)) {
            $result = tap($obj)->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $obj = Category::find($id);
        if (!is_null($obj)) {
            $result = tap($obj)->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

    public function indexBooks(int $id)
    {

        $obj = Category::find($id);
        if (!is_null($obj)) {
            $result = $obj->books;
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }



    function rules(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => "required|unique:categories"


        ]);
    }
}
