<?php

namespace App\Models\Financial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
	use SoftDeletes;
	
	protected $connection = 'mysql_financial';
	
	protected $table = 'financial_contract';
	
	/**
	 * 需要被转换成日期的属性。
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $guarded = [];
	
	/**
	 * 从属于一条快递
	 */
	public function express()
	{
		return $this->belongsTo('App\Models\Financial\Express');
	}
	
	/**
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\Financial\User', 'financial_user_id');
	}
	
	public function setRawAttributes(array $attributes, $sync = false)
	{
		$change_attributes = config('financial.attributes');
		$appends_attributes = [];
		foreach ($change_attributes as $key => $val) {
			$appends_attributes[$key] = $attributes[$val];
		}
		$this->attributes = array_merge($appends_attributes, $attributes);
		if ($sync) {
			$this->syncOriginal();
		}
		return $this;
	}
	
	public function setAttribute($key, $value)
	{
		$change_attributes = config('financial.attributes');
		if (array_key_exists($key, $change_attributes)) {
			$append = $change_attributes[$key];
			$this->attributes[$append] = $value;
			return $this;
		}
		parent::setAttribute($key, $value);
		return $this;
	}
	
	public function __call($method, $parameters)
	{
		$change_attributes = config('financial.attributes');
		if (strpos($method, 'where') !== false && in_array($parameters[0], array_keys($change_attributes))) {
			$parameters[0] = $change_attributes[$parameters[0]];
		}
		
		if ($method == 'insert') {
			foreach ($parameters[0] as &$val) {
				if ($tmp_arr = array_intersect(array_keys($val), array_keys($change_attributes))) {
					foreach ($tmp_arr as $tmp_val) {
						$val[$change_attributes[$tmp_val]] = $val[$tmp_val];
						unset($val[$tmp_val]);
					}
				}
			}
		}
		
		return parent::__call($method, $parameters);
	}
	
}
