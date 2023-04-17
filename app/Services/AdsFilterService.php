<?php


namespace App\Services;

use App\Models\{User,
    Ad,
    AdAge,
    AdAudience,
    AdGender,
    StatsAgeSoldier,
    StatsAudienceSoldier,
    StatsCitySoldier,
    StatsGenderSoldier,
    StatsCountrySoldier,
    AdCity};


class AdsFilterService
{
    public static function getAdsQuery($soldier_id)
    {
        $soldier = User::with(['statsAgeSoldier', 'statsCountrySoldier', 'statsGenderSoldier', 'statsAudienceSoldier'])->find($soldier_id);
        $target_ages = StatsAgeSoldier::where('user_id', $soldier_id)->groupBy('item_id')->orderByRaw('SUM(visitors_number) DESC')->take(3)->pluck('age_id');
        $target_gender = StatsGenderSoldier::where('user_id', $soldier_id)->pluck('gender_id');
        $target_audience = StatsAudienceSoldier::where('user_id', $soldier_id)->groupBy('item_id')->orderByRaw('SUM(visitors_number) DESC')->take(5)->pluck('audience_id');
        $target_cities = StatsCitySoldier::where('user_id', $soldier_id)->groupBy('item_id')->orderByRaw('SUM(visitors_number) DESC')->take(5)->pluck('city_id');
        $target_country = $soldier->statsCountrySoldier->pluck('country_id');

        $saudi_country = StatsCountrySoldier::select("*", \DB::raw('SUM(visitors_number) as total'))->where('user_id', $soldier_id)->where('country_id', 1)->having('total', '>', 5)->first();
        if (!$saudi_country) {
            return Ad::where('id', 0);
        }
        return Ad::where(function ($query) use ($target_ages, $target_gender, $target_audience, $target_country, $target_cities) {
            // return $query->whereHas('ages',function($query2) use($target_ages){
            //     return $query2->whereIn('age_id',$target_ages);
            // })
            return $query
                ->WhereHas('genders', function ($query) use ($target_gender) {
                    $query->whereIn('gender_id', $target_gender);
                })->WhereHas('audiences', function ($query) use ($target_audience) {
                    $query->whereIn('audience_id', $target_audience);
                })->WhereHas('countries', function ($query) use ($target_country) {
                    $query->whereIn('country_id', $target_country);
                })->WhereHas('cities', function ($query) use ($target_cities) {
                    $query->whereIn('city_id', $target_cities);
                });

        });
    }


    public static function getAdSoldiersQuery($ad_id)
    {
        $target_ages = [];

        $target_genders = AdGender::where('ad_id', $ad_id)->pluck('gender_id');

        $target_audiences = AdAudience::whereAdId($ad_id)->pluck('audience_id');
        $target_cities = AdCity::whereAdId($ad_id)->pluck('city_id');


        return User::whereUserType('soldier')->where(function ($query) use ($target_genders, $target_audiences, $target_cities) {
            return $query->whereHas('statsGenderSoldier', function ($query) use ($target_genders) {
                return $query->whereIn('gender_id', $target_genders);

            })->whereHas('statsAudienceSoldierView', function ($query) use ($target_audiences, $target_cities) {
                return $query->whereIn('audience_id', $target_audiences);

            })->whereHas('statsCitySoldierView', function ($query) use ($target_cities) {
                return $query->whereIn('city_id', $target_cities);

            })->whereHas('statsCountrySoldier', function ($query) {
                return $query->select("*", \DB::raw('SUM(visitors_number) as total'))->where('country_id', 1)->having('total', '>', 5)->whereCountryId(1);
            });
        });

    }

}
