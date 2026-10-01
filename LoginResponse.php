<?php

    namespace App\Http\Responses;

    use Illuminate\Http\Request;
    use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
    use Illuminate\Support\Facades\Auth;

    class LoginResponse implements LoginResponseContract
    {
        /**
         * @param $request
         * @return mixed
         */
        public function toResponse($request)
        {
            if (in_array(Auth::user()->role, ['admin', 'sailor'], true)) {
                return redirect()->route('sailor.dashboard');
            }

            return redirect()->route('sailor.home.dashboard');
        }
    }