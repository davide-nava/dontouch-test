<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\AccessOperationEvent;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Contracts\Routing\ResponseFactory;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService)
    {
    }

    public function readAll()
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@readAll'));

            $profiles = $this->profileService->all();

            if ($profiles) {
                return response()->json(['message' => 'OK', 'data' => $profiles], 200);
            } else {
                return response()->json(['message' => 'Not Found', 'data' => null], 404);
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function read(int $id)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@read'));

            Log::debug('Read profile {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => 'Bad Request', 'data' => null], 400);
            } else {
                $profile = $this->profileService->find($id);

                if ($profile) {
                    return response()->json(['message' => 'OK', 'data' => $profile], 200);
                } else {
                    return response()->json(['message' => 'Not Found', 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

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

            $validator->safe()->all();

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {
                $data = $this->validateRequest($request->all());

                $this->profileService->create($data);

                return response()->json(['message' => 'OK', 'data' => null], 201);
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    private function validateRequest($data): array
    {
        $data['id'] = filter_input($data['id'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
        $data['cognome'] = filter_input($data['cognome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['nome'] = filter_input($data['nome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['numero_di_telefono'] = filter_input($data['numero_di_telefono'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['data_di_creazione'] = filter_input($data['data_di_creazione'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['data_di_modifica'] = filter_input($data['data_di_modifica'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);

        return $data;
    }

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

                    return response()->json(['message' => 'OK', 'data' => $profile], 200);
                } else {
                    return response()->json(['message' => 'Not Found', 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function delete($id)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileController@delete'));

            Log::debug('Delete profile {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => 'Bad Request', 'data' => null], 400);
            } else {

                if ($this->profileService->delete($id)) {
                    return response()->json(['message' => 'OK', 'data' => null], 200);
                } else {
                    return response()->json(['message' => 'Not Found', 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }
}
