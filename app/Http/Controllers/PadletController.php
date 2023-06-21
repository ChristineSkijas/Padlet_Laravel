<?php

namespace App\Http\Controllers;

use App\Models\Entrie;
use App\Models\Padlet;
use App\Models\User;
use App\Models\Userright;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PadletController extends Controller
{
    public function index()
    {
        $padlets = Padlet::with(['user', 'entries', 'userrights'])->get();
        return response()->json($padlets, 200);
    }

    public function show($padlet)
    {
        $padlet = Padlet::find($padlet);
        return view('padlets.show', compact('padlet'));
    }

    public function findById(string $id): JsonResponse
    {
        $padlet = Padlet::where('id', $id)
            ->with(['user', 'entries', 'userrights'])->first();
        return $padlet != null ? response()->json($padlet, 200) : response()->json(null, 200);
    }

    public function checkID(string $id): JsonResponse
    {
        $padlet = Padlet::where('id', $id)->first();
        return $padlet != null ? response()->json(true, 200) : response()->json(false, 200);
    }

    //eigentlich genau wie in der Übung beim bookstore
    public function findBySearchTerm(string $searchTerm): JsonResponse
    {
        $padlets = Padlet::with(['user', 'entries', 'userrights', 'entries.comments', 'entries.ratings'])
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('user', function ($query) use ($searchTerm) {
                $query->where('firstName', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('lastName', 'LIKE', '%' . $searchTerm . '%');
            })->get();
        return response()->json($padlets, 200);
    }

    /** zum Speichern eines Padlets */
    public function save(Request $request): JsonResponse {

        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $padlet = Padlet::create($request->all());

            DB::commit();
            return response()->json($padlet, 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Padlet-Sicherung fehlgeschlagen: " . $e->getMessage(), 420);
        }

    }

    /** Helfermethode, damit das Daumt korrekt gespeichert werden kann */
    private function parseRequest(Request $request): Request
    {
        $date = new \DateTime($request->created_at);
        $request['published'] = $date;
        return $request;
    }

    /** Update-Methode fürs Padlet, ähnlich wie in der Übung  */
    public function update(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $padlet = Padlet::with(['user', 'entries', 'userrights'])
                ->where('id', $id)->first();
            if ($padlet != null) {
                $request = $this->parseRequest($request);
                $padlet->update($request->all());

                // Nutzerrechte updaten
                $padlet->userrights()->delete();

                if (isset($request['userrights']) && is_array($request['userrights'])) {
                    foreach ($request['userrights'] as $userrights) {

                        $userrights = Userright::firstOrNew(
                            ['padlet_id' => $userrights['padlet_id'],
                                'user_id' => $userrights['user_id'],
                                'read' => $userrights['read'],
                                'edit' => $userrights['edit'],
                                'delete' => $userrights['delete']]);
                        $padlet->userrights()->save($userrights);
                    }
                }
                $padlet->save();
            }
            DB::commit();
            $padlet1 = Padlet::with(['user', 'entries', 'userrights'])
                ->where('id', $id)->first(); // return a vaild http response
            return response()->json($padlet1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("Udpate fehlgeschlagen: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $id): JsonResponse
    {
        $padlet = Padlet::where('id', $id)->first();
        if ($padlet != null) {
            $padlet->delete();
            return response()->json('Padlet (' . $id . ') erfolgreich gelöscht!', 200);
        } else
            return response()->json('Padlet könnte nicht gelöscht werden - nicht vorhanden!', 422);
    }

}
