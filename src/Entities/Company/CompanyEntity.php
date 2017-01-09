<?php

namespace CloudManaged\FreeAgent\Entities\Company;

use CloudManaged\FreeAgent\Entities\EntityInterface;
use CloudManaged\FreeAgent\Entities\AbstractEntity;

/**
 * Class Company
 *
 * url
 * name
 * subdomain
 * type The company type either UKLimitedCompany, UKSoleTrader, UKPartnership, UKLimitedLiabilityPartnership or UniversalCompany
 * currency The base accounting currency
 * mileage_units Either miles or kilometers
 * company_start_date
 * freeagent_start_date
 * first_accounting_year_end
 * company_registration_number
 * sales_tax_registration_status
 * sales_tax_name
 * sales_tax_registration_number
 * sales_tax_rates
 * sales_tax_is_value_added
 * supports_auto_sales_tax_on_purchases
 *
 * @package CloudManaged\FreeAgent\Entities\Company
 */
class CompanyEntity extends AbstractEntity implements EntityInterface
{
    protected $url;
    protected $name;
    protected $subdomain;
    protected $type;
    protected $currency;
    protected $mileage_units;
    protected $company_start_date;
    protected $freeagent_start_date;
    protected $first_accounting_year_end;
    protected $company_registration_number;
    protected $sales_tax_registration_status;
    protected $sales_tax_name;
    protected $sales_tax_registration_number;
    protected $sales_tax_rates;
    protected $sales_tax_is_value_added;
    protected $supports_auto_sales_tax_on_purchases;

    public function __construct(array $attributes)
    {
        $this->url                                  = $attributes['url'];
        $this->name                                 = $attributes['name'];
        $this->subdomain                            = $attributes['subdomain'];
        $this->type                                 = $attributes['type'];
        $this->currency                             = $attributes['currency'];
        $this->mileage_units                        = $attributes['mileage_units'];
        $this->company_start_date                   = $attributes['company_start_date'];
        $this->freeagent_start_date                 = $attributes['freeagent_start_date'];
        $this->first_accounting_year_end            = $attributes['first_accounting_year_end'];
        $this->company_registration_number          = $attributes['company_registration_number'];
        $this->sales_tax_registration_status        = $attributes['sales_tax_registration_status'];
        $this->sales_tax_name                       = $attributes['sales_tax_name'];
        $this->sales_tax_registration_number        = $attributes['sales_tax_registration_number'];
        $this->sales_tax_rates                      = $attributes['sales_tax_rates'];
        $this->sales_tax_is_value_added             = $attributes['sales_tax_is_value_added'];
        $this->supports_auto_sales_tax_on_purchases = $attributes['supports_auto_sales_tax_on_purchases'];
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
