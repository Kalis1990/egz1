<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'author_id'];

    const SORT_SELECT= [
        ['rate_asc', 'Rating 1 - 9'],
        ['rate_desc', 'Rating 9 - 1'],
        ['title_asc', 'Title A - Z'],
        ['title_desc', 'Title Z - A'],
        ['price_asc', 'Price Low to High'],
        ['price_desc', 'Price High to Low'],
    ];
    public function getAuthor()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function getPhotos()
    {
        return $this->hasMany(BookImage::class, 'book_id', 'id');
    }

    public function lastImageUrl()
    {
        return $this->getPhotos()->orderBy('id', 'desc')->first()->url;
    }

    public function addImages(?array $photos): self
    {
        if ($photos) {
            $bookImage = [];
            $time = Carbon::now();
            foreach ($photos as $photo) {
                $ext = $photo->getClientOriginalExtension();
                $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $file = $name . '-' . rand(100000, 999999) . '.' . $ext;
                // $Image = Image::make($photo)->pixelate(12);
                // $Image->save(public_path().'/images/'.$file);
                $photo->move(public_path() . '/images', $file);

                $bookImage[] = [
                    'url' => asset('/images') . '/' . $file,
                    'book_id' => $this->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            }
            BookImage::insert($bookImage);
        }
        return $this;
    }
    public function removeImages(?array $photos) : self
    {
        if ($photos) {
            $toDelete = BookImage::whereIn('id', $photos)->get();
            foreach ($toDelete as $photo) {
                $file = public_path().'/images/' .pathinfo($photo->url, PATHINFO_FILENAME).'.'.pathinfo($photo->url, PATHINFO_EXTENSION);
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            BookImage::destroy($photos);
        }
        return $this;
    }
 
}