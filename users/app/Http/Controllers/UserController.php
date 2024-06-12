<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Services\RabbitMQService;
use \App\Models\User;

class UserController extends Controller {
    public function store(Request $request) {

        try {
            $request = $request->all();
            $mqService = new RabbitMQService();
            $mqService->publish(json_encode($request));

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
