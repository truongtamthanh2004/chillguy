<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GetInTouch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetInTouchController extends Controller
{
    public function index()
    {
        return view('home');
    }


    public function submitContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();

            $contact = new GetInTouch();
            $contact->fill($validatedData);
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Gửi tin nhắn thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gửi tin nhắn thất bại: ' . $e->getMessage()
            ], 500);
        }
    }
}
