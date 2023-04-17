<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\AdDevices;
use App\Models\AdTime;
use App\Models\AdUser;
use App\Models\User;
use Spatie\Analytics\Period;
use App\Models\StatsAgeSoldier;
use Spatie\Analytics\Analytics;
use App\Models\StatsCitySoldier;
use App\Models\StatsGenderSoldier;
use App\Models\StatsCountrySoldier;
use App\Models\StatsAudienceSoldier;

class StatsService
{
    public static function getAdvertiserWeekStats(User $user)
    {
        $ads = $user->ads()->get();
        $result = [0, 0, 0, 0, 0, 0, 0];
        if (!$ads->count()) {
            return $result;
        }
        $filters = [];
        foreach ($ads as $ad) {
            $filters[] = 'ga:pagePath=@/ad/' . $ad->id;
        }

        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days(7),
            'ga:sessions',
            [
                'metrics' => 'ga:users',
                'dimensions' => 'ga:dayOfWeek',
                'filters' => implode(',', $filters)
            ]
        );


        if (isset($visitorResponse['rows'])) {
            foreach ($visitorResponse['rows'] as $k => $v) {
                $result[$v[0]] = $v[1];
            }
        }
        return $result;
    }

    public static function getAdStats(Ad $ad)
    {

    }

    public static function getAdCountryStats(Ad $ad, User $soldier = null)
    {
        return StatsCountrySoldier::whereItemType('ad')
            ->whereBelongsTo($ad)
            ->with('country')
            ->when($soldier, function ($query) use ($soldier) {
                return $query->whereBelongsTo($soldier);
            })
            ->get()
            ->groupBy('country.value')->map(function ($element) {
                return $element->sum('visitors_number');
            })->toArray();
    }

    public static function getDevices(Ad $ad)
    {
        $data = AdDevices::where('ad_id', $ad->id)->where('key', 'devices')->get()->toArray();

        return $data;
    }

    public static function getBrowsers(Ad $ad)
    {
        $data = AdDevices::where('ad_id', $ad->id)->where('key', 'browsers')->get()->toArray();

        return $data;
    }

    public static function getOperatingSystem(Ad $ad)
    {
        $data = AdDevices::where('ad_id', $ad->id)->where('key', 'operating_system')->get()->toArray();

        return $data;
    }

    public static function getAdCityStats(Ad $ad, User $soldier = null)
    {
        return StatsCitySoldier::whereItemType('ad')
            ->whereBelongsTo($ad)
            ->with('city')
            ->when($soldier, function ($query) use ($soldier) {
                return $query->whereBelongsTo($soldier);
            })
            ->get()
            ->groupBy('city.value')->map(function ($element) {
                return $element->sum('visitors_number');
            })->toArray();
    }

    public static function getAdAgeStats(Ad $ad, User $soldier = null)
    {
        return StatsAgeSoldier::whereItemType('ad')
            ->whereBelongsTo($ad)
            ->with('age')
            ->when($soldier, function ($query) use ($soldier) {
                return $query->whereBelongsTo($soldier);
            })
            ->get()
            ->groupBy('age.value')->map(function ($element) {
                return $element->sum('visitors_number');
            })->toArray();
    }

    public static function getAdGenderStats(Ad $ad, User $soldier = null)
    {
        return StatsGenderSoldier::whereItemType('ad')
            ->whereBelongsTo($ad)
            ->with('gender')
            ->when($soldier, function ($query) use ($soldier) {
                return $query->whereBelongsTo($soldier);
            })
            ->get()
            ->groupBy('gender.value')->map(function ($element) {
                return $element->sum('visitors_number');
            })->toArray();
    }

    public static function getAdAudienceStats(Ad $ad, User $soldier = null)
    {
        return StatsAudienceSoldier::whereItemType('ad')
            ->whereBelongsTo($ad)
            ->with('audience')
            ->when($soldier, function ($query) use ($soldier) {
                return $query->whereBelongsTo($soldier);
            })
            ->get()
            ->groupBy('audience.value')->map(function ($element) {
                return $element->sum('visitors_number');
            })->toArray();
    }

}
