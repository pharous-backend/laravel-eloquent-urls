<?php

namespace Pharous\Laravel\Eloquent\URL;

use Exception;
use Pharaonic\Laravel\Helpers\Traits\HasCustomAttributes;

/**
 * Has URLs Trait
 *
 * @version 1.0
 * @author Raggi <support@pharous.io>
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
trait HasURLs
{
    use HasCustomAttributes;

    /**
     * URLs Atrributes on Save/Create
     *
     * @var array
     */
    protected static $URLsAttributesAction = [];

    /**
     * Init
     * 
     * @return void
     */
    public function initializeHasURLs()
    {
        $attrs = get_class_vars(self::class);
        $attrs = array_merge($attrs['URLsAttributes'] ?? []);

        foreach ($attrs as $attr)
            $this->fillable[] = $attr;
    }

    /**
     * Boot 
     *
     * @return void
     */
    protected static function bootHasURLs()
    {
        $attrs = get_class_vars(self::class);
        $attrs = array_merge($attrs['URLsAttributes'] ?? []);

        // Created
        self::creating(function ($model) use ($attrs) {
            foreach ($model->getAttributes() as $name => $value) {
                if (in_array($name, $attrs)) {
                    self::$URLsAttributesAction[$name] = $value;
                    unset($model->{$name});
                }
            }
        });

        // Created
        self::created(function ($model) {
            if (count(self::$URLsAttributesAction) > 0) {
                foreach (self::$URLsAttributesAction as $name => $url)
                    $model->setAttribute($name, $model->_setURLAttribute($name, $url));
            }
        });

        // Retrieving
        self::retrieved(function ($model) use ($attrs) {
            try {
                foreach ($attrs as $attr) $model->addGetterAttribute($attr, '_getURLAttribute');
                foreach ($attrs as $attr) $model->addSetterAttribute($attr, '_setURLAttribute');
            } catch (\Throwable $e) {
                throw new Exception('You have to use Pharaonic\Laravel\Helpers\Traits\HasCustomAttributes as a trait in ' . get_class($model));
            }
        });


        // Deleting
        self::deleting(function ($model) {
            $model->clearURLs();
        });
    }

    /**
     * Getting URL
     */
    public function _getURLAttribute($key)
    {
        if ($this->isURLAttribute($key)) {
            $url = $this->URLs()->where('name', $key)->first();
            return $url ?? null;
        }
    }

    /**
     * Setting URL
     */
    public function _setURLAttribute($key, $value)
    {
        if ($this->isURLAttribute($key)) {
            $url = $this->URLs()->where('name', $key)->first();

            if ($url) {
                $url->update(['url' => $value]);
                return $url;
            } else {
                $this->URLs()->create([
                    'name'  => $key,
                    'url'   => $value,
                ]);

                return $url;
            }
        }

        return null;
    }

    /**
     * Getting URLs attributes
     */
    public function getURLsAttributes(): array
    {
        $fields = isset($this->URLsAttributes) && is_array($this->URLsAttributes) ? $this->URLsAttributes : [];
        return array_merge(config('Pharous.urls.fields', []), $fields);
    }

    /**
     * Check if file attribute
     */
    public function isURLAttribute(string $key): bool
    {
        return in_array($key, $this->getURLsAttributes());
    }

    /**
     * Get All URLs
     */
    public function URLs()
    {
        return $this->morphMany(URL::class, 'model');
    }

    /**
     * Clear All URLs
     */
    public function clearURLs()
    {
        foreach ($this->URLs()->get() as $url) {
            $url->url->delete();
        }
    }
}
