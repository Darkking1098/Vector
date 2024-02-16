<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiToken
 * 
 * @property int $id
 * @property int $api_user_id
 * @property int $api_token_varient_id
 * @property string $api_token
 * 
 * @property ApiUser $api_user
 * @property ApiTokenVarient $api_token_varient
 *
 * @package Vector\Spider\Models
 */
class ApiToken extends Model
{
	protected $table = 'api_tokens';
	public $timestamps = false;

	protected $casts = [
		'api_user_id' => 'int',
		'api_token_varient_id' => 'int'
	];

	protected $hidden = [
		'api_token'
	];

	protected $fillable = [
		'api_user_id',
		'api_token_varient_id',
		'api_token'
	];

	public function api_user()
	{
		return $this->belongsTo(ApiUser::class);
	}

	public function api_token_varient()
	{
		return $this->belongsTo(ApiTokenVarient::class);
	}
}
