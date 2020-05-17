<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class Product
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property double $price
 * @property integer $category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Product extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'products';

    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
    ];

    protected $fillable = ['name', 'price', 'category_id', 'description', 'image', 'hit', 'new', 'recommend'];

    /**
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getPivot(): Pivot
    {
        return $this->pivot;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;

    }

    public function getPriceForCount()
    {

        if (!is_null($this->getPivot())) {
            return $this->getPivot()->count * $this->getPrice();
        }
        return $this->getPrice();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setNewAttribute($value) {
        $this->attributes['new'] = $value === 'on' ? 1:0;
    }

    public function setHitAttribute($value) {
        $this->attributes['hit'] = $value === 'on' ? 1:0;
    }

    public function setRecommendAttribute($value) {
        $this->attributes['recommend'] = $value === 'on' ? 1:0;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
