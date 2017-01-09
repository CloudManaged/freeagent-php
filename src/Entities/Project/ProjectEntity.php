<?php

namespace CloudManaged\FreeAgent\Entities\Project;
use CloudManaged\FreeAgent\Entities\AbstractEntity;
use CloudManaged\FreeAgent\Entities\EntityInterface;

/**
 * Class Project
 *
 * url
 * name
 * contact
 * currency
 * created_at
 * updated_at
 *
 * @package CloudManaged\FreeAgent\Entities\Project
 */
class ProjectEntity extends AbstractEntity implements EntityInterface
{
    protected $url;
    protected $name;
    protected $contact;
    protected $currency;
    protected $created_at;
    protected $updated_at;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray()
    {
        return compact(array_keys(get_defined_vars()));
    }

    public function __toString()
    {
        return $this->name;
    }
}
