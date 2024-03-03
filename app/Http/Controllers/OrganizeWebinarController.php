<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class OrganizeWebinarController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {

            $startDate = $request->get('date');
            $theme = $request->get('theme');
            $link = $request->get('link');
            $nbParticipants = $request->get('nbParticipants');

            if (empty($startDate) || empty($theme) || empty($link) || empty($nbParticipants)) {
                throw new InvalidArgumentException('La date, le thème et le lien sont obligatoires !');
            }

            $startDate = date_create_immutable($startDate);
            $currentDate = date_create_immutable(date('Y-m-d H:i:s'));

            if (date_diff($startDate, $currentDate)->days < 3) {
                throw new InvalidArgumentException('Un webinaire ne peut être programmé que 03 jours à l\'avance !');
            }

            if ($nbParticipants <= 0 || $nbParticipants > 1000) {
                throw new InvalidArgumentException('Le nombre de participants doit être compris entre 0 et 1000');

            }

            $webinar = new Webinar();
            $webinar->fill([
                'date' => $startDate,
                'theme' => $theme,
                'link' => $link,
                'nbParticipants' => $nbParticipants
            ])->save();

        } catch (InvalidArgumentException $e) {
            return response()->json([
                'status' => 200,
                'message' => $e->getMessage()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 200,
                'message' => $e->getMessage()
                //'Une erreur est survenue ! Veuillez contacter l\'équipe technique'
            ]);
        }

        return response()->json($webinar);
    }
}
