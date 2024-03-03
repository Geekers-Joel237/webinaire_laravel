<?php

namespace App\Http\Factories;

use Illuminate\Http\Request;
use InvalidArgumentException;

class OrganizeWebinarCommandFactory
{

    public static function buildFromRequest(Request $request)
    {
        $startDate = $request->get('date');
        $theme = $request->get('theme');
        $link = $request->get('link');
        $nbParticipants = $request->get('nbParticipants');
        $startDate = date_create_immutable($startDate);
        $currentDate = date_create_immutable(date('Y-m-d H:i:s'));

        if (empty($startDate) || empty($theme) || empty($link) || empty($nbParticipants)) {
            throw new InvalidArgumentException('La date, le thème et le lien sont obligatoires !');
        }

        return OrganizeWebinarCommand();
    }
}
