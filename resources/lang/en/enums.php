<?php

use App\Enums\AccountExpansion;
use App\Enums\RealmlistGamebuild;
use App\Enums\RealmlistIcon;

return [
    AccountExpansion::class => [
        AccountExpansion::Classic => 'Classic',
        AccountExpansion::TBC => 'The Burning Crusade',
        AccountExpansion::WoTLK => 'Wrath of The Lich King',
        AccountExpansion::Cataclysm => 'Cataclysm',
        AccountExpansion::MOP => 'Mists Of Pandaria',
        AccountExpansion::WOD => 'Warlords of Draenor',
        AccountExpansion::Legion => 'Legion',
        AccountExpansion::BFA => 'Battle For Azeroth',
        AccountExpansion::SL => 'Shadowlands'
    ],

    RealmlistGamebuild::class => [
        RealmlistGamebuild::Classic => 'Classic',
        RealmlistGamebuild::Classic_OneTwelveOne => 'Classic 1.12.1',
        RealmlistGamebuild::Classic_OneTwelveTwo => 'Classic 1.12.2',
        RealmlistGamebuild::TBC => 'The Burning Crusade',
        RealmlistGamebuild::WoTLK => 'Wrath of The Lich King',
        RealmlistGamebuild::WoTLK_ThreeOneThree => 'Wrath of The Lich King 3.1.3',
        RealmlistGamebuild::WoTLK_ThreeTwoZero => 'Wrath of The Lich King 3.2.0',
        RealmlistGamebuild::WoTLK_ThreeTwoTwoA => 'Wrath of The Lich King 3.2.2a',
        RealmlistGamebuild::WoTLK_ThreeThreeZero => 'Wrath of The Lich King 3.3.0',
        RealmlistGamebuild::WoTLK_ThreeThreeZeroA => 'Wrath of The Lich King 3.3.0a',
        RealmlistGamebuild::WoTLK_ThreeThreeTwo => 'Wrath of The Lich King 3.3.2',
        RealmlistGamebuild::WoTLK_ThreeThreeThree => 'Wrath of The Lich King 3.3.3',
        RealmlistGamebuild::WoTLK_ThreeThreeThreeA => 'Wrath of The Lich King 3.3.3a',
        RealmlistGamebuild::WoTLK_ThreeThreeFiveA => 'Wrath of The Lich King 3.3.5a',
    ],

    RealmlistIcon::class => [
        RealmlistIcon::Normal => 'Normal',
        RealmlistIcon::PvP => 'PvP',
        RealmlistIcon::RP => 'RP',
        RealmlistIcon::RPPvP => 'RP PvP',
    ]


];
