<?php

namespace Pharous\Laravel\Eloquent\URL;

use Illuminate\Database\Eloquent\Model;

/**
 * URL Model
 *
 * @version 1.0
 * @author Raggi <support@pharous.io>
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class URL extends Model
{

    /**
     * URLs Table
     *
     * @var string
     */
    public $table = 'urls';

    /**
     * Fillable Columns
     *
     * @var array
     */
    protected $fillable = ['name', 'url', 'clicks', 'data'];


    /**
     * Casts Columns
     *
     * @var array
     */
    protected $casts = [
        'clicks'    => 'integer',
        'data'      => 'array'
    ];

    /**
     * Get the owning model.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * URL Clicks
     *
     * @param integer $count
     * @return void
     */
    public function click(int $count = 1)
    {
        return $this->increment('clicks', $count);
    }
}
