<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Authority
 *
 * @property int $id
 * @property string $local_authority_id_code
 * @property string $name
 * @property string $region_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Authority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Authority newQuery()
 * @method static \Illuminate\Database\Query\Builder|Authority onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Authority query()
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereLocalAuthorityIdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Authority whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Authority withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Authority withoutTrashed()
 */
	class Authority extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Establishment
 *
 * @property int $id
 * @property string $business_name
 * @property string $business_type
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $address_line_3
 * @property string $postcode
 * @property string $rating_value
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Establishment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereAddressLine3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereBusinessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereRatingValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Establishment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Establishment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Establishment withoutTrashed()
 */
	class Establishment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

