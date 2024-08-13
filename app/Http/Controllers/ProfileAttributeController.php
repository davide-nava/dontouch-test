<?php

namespace App\Http\Controllers;

use App\Services\ProfileAttributeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\AccessOperationEvent;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;

class ProfileAttributeController extends Controller
{
    public function __construct(protected ProfileAttributeService $profileAttributeService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/resource.json",
     *     @OA\Response(response="200", description="An example resource")
     *     @OA\Response(response="404", description="Not Found")
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function readAll()
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileAttributeController@readAll'));
            $profileAttributes = $this->profileAttributeService->all();

            if ($profileAttributes) {
                return response()->json(['message' => 'OK', 'data' => $profileAttributes]);
            } else {
                return response()->json(['message' => 'Not Found', 'data' => null], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function read(int $id)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileAttributeController@read'));

            Log::debug('Reading profile attribute with id: {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => 'Bad Request', 'data' => null], 400);
            } else {
                $profileAttribute = $this->profileAttributeService->find($id);

                if ($profileAttribute) {
                    return response()->json(['message' => 'OK', 'data' => $profileAttribute]);
                } else {
                    return response()->json(['message' => 'Not Found', 'data' => null], 404);
                }
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    private function validateRequest($data): array
    {
        $data['profile_id'] = filter_input($data['profile_id'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
        $data['attribute'] = filter_input($data['attribute'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['data_di_creazione'] = filter_input($data['data_di_creazione'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);
        $data['data_di_modifica'] = filter_input($data['data_di_modifica'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING);

        return $data;
    }

    public function create(Request $request)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileAttributeController@create'));

            Log::debug('Create profile attribute {req}', ['req' => $request]);

            $validator = Validator::make($request->all(), [
                'profile_id' => 'required|number',
                'attribute' => 'required|string',
                'data_di_creazione' => 'required|date',
                'data_di_modifica' => 'required|date',
            ]);

            $validator->safe()->all();

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {

                $data = $this->validateRequest($request->all());

                $this->profileAttributeService->create($data);
                return response()->json(['message' => 'OK', 'data' => null], 201);
            }
        } catch (Exception $e) {
            Log::error('Error: \nMessage: {message}\nTrace: {trace}\nFile: {file}\nLine: {line}', ['message' => $e->getMessage(), "trace" => $e->getTraceAsString(), "file" => $e->getFile(), "line" => $e->getLine()]);
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            Event::dispatch(new AccessOperationEvent('ProfileAttributeController@update'));

            Log::debug('Update profile attribute {req}', ['req' => $request]);

            $validator = Validator::make($request->all(), [
                'profile_id' => 'required|number',
                'attribute' => 'required|string',
                'data_di_creazione' => 'required|date',
                'data_di_modifica' => 'required|date',
            ]);

            $validator->safe()->all();

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {
                $data = $this->validateRequest($request->all());

                $profileAttribute = $this->profileAttributeService->find($data['profile_id'], $data['attribute']);

                if ($profileAttribute) {
                    $this->profileAttributeService->update($data);

                    $profileAttribute = $this->profileAttributeService->find($data['profile_id'], $data['attribute']);

                    return response()->json(['message' => 'OK', 'data' => $profileAttribute]);
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
            Event::dispatch(new AccessOperationEvent('ProfileAttributeController@delete'));

            Log::debug('Delete profile attribute {id}', ['id' => $id]);

            if ($id == null || $id <= 0) {
                return response()->json(['message' => 'Bad Request', 'data' => null], 400);
            } else {

                if ($this->profileAttributeService->delete($id)) {
                    return response()->json(['message' => 'OK', 'data' => null]);
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
