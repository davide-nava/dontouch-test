<?php

namespace App\Http\Controllers;

use App\Events\AccessOperationEvent;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/profile",
     *     summary="Gel all profiles",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function readAll()
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@readAll'));
            Log::debug('Reading all profile ');

            $profiles = $this->profileService->all();

            if ($profiles) {
                return response()->json(['message' => __('messages.ok'), 'data' => $profiles], 200);
            } else {
                return response()->json(['message' => __('messages.notFound'), 'data' => null], 404);
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/profile/{id}",
     *     summary="Gel profile",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function read($id)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@read'));

            Log::debug('Read profile {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => __('messages.badRequest'), 'data' => null], 400);
            } else {
                $profile = $this->profileService->find($id);

                if ($profile) {
                    return response()->json(['message' => __('messages.ok'), 'data' => $profile], 200);
                } else {
                    return response()->json(['message' => __('messages.notFound'), 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/profile",
     *     summary="Create profile",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function create(Request $request)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@create'));

            Log::debug('Update profile {req}', ['req' => $request]);

            $validator = Validator::make($request->all(), [
                'nome' => 'required|string',
                'cognome' => 'required|string',
                'numero_di_telefono' => 'required|string',
                'data_di_creazione' => 'required|date',
                'data_di_modifica' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {
                $data = $this->validateRequest($request->all(), false);

                $this->profileService->create($data);

                return response()->json(['message' => __('messages.ok'), 'data' => $data], 201);
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    private function validateRequest($data, bool $testId = true): array
    {
        if ($testId) {
            $data['id'] = filter_var($data['id'], FILTER_VALIDATE_INT);
        }

        $data['cognome'] = filter_var($data['cognome'], FILTER_SANITIZE_STRING);
        $data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
        $data['numero_di_telefono'] = filter_var($data['numero_di_telefono'], FILTER_SANITIZE_STRING);
        $data['data_di_creazione'] = filter_var($data['data_di_creazione'], FILTER_SANITIZE_STRING);
        $data['data_di_modifica'] = filter_var($data['data_di_modifica'], FILTER_SANITIZE_STRING);

        return $data;
    }

    /**
     * @OA\Put(
     *     path="/api/profile/{id}",
     *     summary="Update profile",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function update(Request $request)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@update'));

            Log::debug('Update profile {req}', ['req' => $request]);

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'nome' => 'required|string',
                'cognome' => 'required|string',
                'numero_di_telefono' => 'required|string',
                'data_di_creazione' => 'required|date',
                'data_di_modifica' => 'required|date',
            ]);

            $validator->safe()->all();

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {
                $data = $this->validateRequest($request->all());

                $profile = $this->profileService->find($data['id']);

                if ($profile) {

                    $this->profileService->update($data);

                    $profile = $this->profileService->find($data['id']);

                    return response()->json(['message' => __('messages.ok'), 'data' => $profile], 200);
                } else {
                    return response()->json(['message' => __('messages.notFound'), 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/profile/{id}",
     *     summary="Delete profile",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function delete($id)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@delete'));

            Log::debug('Delete profile {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => __('messages.badRequest'), 'data' => null], 400);
            } else {

                if ($this->profileService->delete($id)) {
                    return response()->json(['message' => __('messages.ok'), 'data' => null], 200);
                } else {
                    return response()->json(['message' => __('messages.notFound'), 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }
}
