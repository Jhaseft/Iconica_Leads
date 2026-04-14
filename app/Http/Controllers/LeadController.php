<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'nombre_completo'    => 'required|string|max:100',
                'cargo'              => 'required|string|max:80',
                'telefono'           => 'required|string|max:30',
                'correo_electronico' => 'nullable|email|max:254',
                'nombre_empresa'     => 'required|string|max:150',
                'sector_industria'   => 'required|string|max:150',
                'ciudad'             => 'required|string|max:100',
                'utm_source'         => 'nullable|string|max:100',
                'utm_medium'         => 'nullable|string|max:100',
                'utm_campaign'       => 'nullable|string|max:100',
            ]);

            $data['ip_origen'] = $request->ip();

            $lead = Lead::create($data);

            return response()->json(['message' => 'Lead guardado.', 'id' => $lead->id], 201);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
