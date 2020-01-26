<?php

namespace App\Nova;

use App\Enums\RealmlistAllowedSecurityLevel;
use App\Enums\RealmlistFlag;
use App\Enums\RealmlistGamebuild;
use App\Enums\RealmlistIcon;
use App\Enums\RealmlistStatus;
use App\Enums\RealmlistTimezone;
use App\Nova\Actions\Realmlist\CreateGameAccount;
use App\Nova\Actions\Realmlist\StatusCheck;
use App\Rules\ValidHostname;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use SimpleSquid\Nova\Fields\Enum\Enum;

class Realmlist extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Realmlist';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'address'
    ];

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string|null
     */
    public function subtitle()
    {
        return $this->address;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('max:32', 'min:1', 'unique:auth.realmlist,name,{{resourceId}}')
                ->creationRules('required'),

            Text::make('Address')
                ->rules(new ValidHostname)
                ->creationRules('required'),

            Text::make('Local Addr.', 'localAddress')
                ->rules(new ValidHostname)
                ->creationRules('required'),

            Text::make('Local Subnet', 'localSubnetMask')
                ->creationRules('required'),

            Number::make('Port')
                ->creationRules('required'),

            Enum::make('Icon')->attachEnum(RealmlistIcon::class),

            Enum::make('Flag')->attachEnum(RealmlistFlag::class),

            Enum::make('Timezone')->attachEnum(RealmlistTimezone::class),

            Enum::make('Req. GM Level', 'allowedSecurityLevel')->attachEnum(RealmlistAllowedSecurityLevel::class),

            Number::make('Population'),

            Enum::make('Game build', 'gamebuild')
                ->attachEnum(RealmlistGamebuild::class),

            // HasMany::make('realmCharacters'),
            HasMany::make('Accounts')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
