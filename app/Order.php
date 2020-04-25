<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Order
 * @package App
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer user_id
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
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
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }


    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }


    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getFullPrice()
    {
        return $this->getProducts()
            ->sum(function (Product $product) {
                return $product->getPriceForCount();
            });
    }

    /**
     * @param string $name
     * @param string $phone
     * @return bool
     */
    public function saveOrder(string $name, string $phone): bool
    {
        if ($this->getStatus() === 0) {
            $this->setName($name);
            $this->setPhone($phone);
            $this->setStatus(1);
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }
}
