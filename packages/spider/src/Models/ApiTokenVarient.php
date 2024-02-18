<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiTokenVarient
 * 
 * @property int $id
 * @property string $api_varient_name
 * @property string $api_varient_permissions
 * @property string $api_varient_env
 * @property int $api_varient_status
 * 
 * @property Collection|ApiToken[] $api_tokens
 *
 * @package Vector\Spider\Models
 */
class ApiTokenVarient extends Model
{
	protected $table = 'api_token_varients';
	public $timestamps = false;

	protected $casts = [
		'api_varient_status' => 'int',
		'api_varient_permissions'=>'array',
	];

	protected $fillable = [
		'api_varient_name',
		'api_varient_permissions',
		'api_varient_env',
		'api_varient_status'
	];

	public function api_tokens()
	{
		return $this->hasMany(ApiToken::class);
	}
}
