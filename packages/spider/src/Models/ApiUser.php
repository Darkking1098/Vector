<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiUser
 * 
 * @property int $id
 * @property string $username
 * @property string $fname
 * @property int $contact
 * @property string $email
 * @property int $country
 * @property int $user_status
 * @property Carbon $created_on
 * 
 * @property Collection|ApiToken[] $api_tokens
 *
 * @package Vector\Spider\Models
 */
class ApiUser extends Model
{
	protected $table = 'api_users';
	public $timestamps = false;

	protected $casts = [
		'contact' => 'int',
		'country' => 'int',
		'user_status' => 'int',
		'created_on' => 'datetime'
	];

	protected $fillable = [
		'username',
		'fname',
		'contact',
		'email',
		'country',
		'user_status',
		'created_on'
	];

	public function api_tokens()
	{
		return $this->hasMany(ApiToken::class);
	}
}
