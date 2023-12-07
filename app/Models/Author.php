<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
   

    protected $fillable = ['name'];

    /**

     * Get the user associated with the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'authorr_id');
    }

    public function books()
{
    return $this->belongsToMany(Book::class, 'author_book',)->withPivot('is_active')->withTimestamps();
}


}
// Author::first()->profile()->create(['home_town'=>'shpam','phone_number'=>'0404']) 

