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
 * App\Models\Game
 *
 * @property int $id
 * @property string $gameid
 * @property string|null $date
 * @property string $start
 * @property string|null $oppcode
 * @property string|null $oppid
 * @property string|null $oppname
 * @property string|null $site
 * @property string|null $stadium
 * @property int|null $quarters
 * @property int|null $ownscore
 * @property int|null $oppscore
 * @property int|null $attend
 * @property string|null $duration
 * @property int $leaguegame
 * @property int $neutralgame
 * @property int $nitegame
 * @property int $postseason
 * @property int $homeaway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $number
 * @property string $type
 * @property int|null $sport_id
 * @property-read array|\Illuminate\Contracts\Translation\Translator|null|string $game_date
 * @property-read float|int $game_length_seconds
 * @property-read string $human_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlayerValue[] $playerValues
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $seasons
 * @property-write mixed $location
 * @property-write mixed $visname
 * @property-read \App\Models\Sport|null $sport
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereAttend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereGameid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereHomeaway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereLeaguegame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereNeutralgame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereNitegame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereOppcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereOppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereOppname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereOppscore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereOwnscore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game wherePostseason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereQuarters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereSportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereStadium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Import
 *
 * @property int $id
 * @property int $status
 * @property int $season_id
 * @property int $sport_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $files
 * @property-read mixed $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImportLog[] $logs
 * @property-read \App\Models\Season $season
 * @property-read \App\Models\Sport $sport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereSportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Import whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Import extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImportLog
 *
 * @property int $id
 * @property int $import_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Import $import
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ImportLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model query()
 * @mixin \Eloquent
 */
	class Model extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Player
 *
 * @property int $id
 * @property string $name
 * @property string|null $checkname
 * @property string|null $uni
 * @property string|null $code
 * @property string|null $year
 * @property int|null $gp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $team_id
 * @property int|null $sport_id
 * @property int|null $player_type_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read int $games_played
 * @property-read null|string $human_title
 * @property-read bool $is_show_defensive
 * @property-read bool $is_show_passing
 * @property-read bool $is_show_receiving
 * @property-read bool $is_show_rushing
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SportBlock[] $hideBlocks
 * @property-read \App\Models\PlayerType|null $playerType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $seasons
 * @property-read \App\Models\Sport|null $sport
 * @property-read \App\Models\Team|null $team
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlayerValue[] $values
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCheckname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereGp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player wherePlayerTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereSportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereYear($value)
 * @mixin \Eloquent
 */
	class Player extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlayerHideBlock
 *
 * @property int $player_id
 * @property int $sport_block_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerHideBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerHideBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerHideBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerHideBlock wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerHideBlock whereSportBlockId($value)
 * @mixin \Eloquent
 */
	class PlayerHideBlock extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlayerType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SportBlock[] $sportBlocks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PlayerType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlayerValue
 *
 * @property int $id
 * @property int $player_id
 * @property string $group
 * @property string $key
 * @property int $game_id
 * @property float $value
 * @property string|null $raw_value
 * @property string|null $context
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\Player $player
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereRawValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerValue whereValue($value)
 * @mixin \Eloquent
 */
	class PlayerValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Season
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $sort
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sport[] $sports
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Season extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sport
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $seasons
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Sport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SportBlock
 *
 * @property int $id
 * @property string $sport_type
 * @property string $title
 * @property string $block
 * @property-read mixed $title_with_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock whereSportType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SportBlock whereTitle($value)
 * @mixin \Eloquent
 */
	class SportBlock extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $title
 * @property int|null $code
 * @property string $shortcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read string $human_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $players
 * @property-write mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereShortcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

