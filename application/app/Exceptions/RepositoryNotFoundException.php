<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class RepositoryNotFoundException extends Exception
{
    /**
     * Throw a new instance of this exception.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return void
     *
     * @throws \App\Exceptions\RepositoryNotFoundException
     */
    public static function throw($user, $repository)
    {
        throw (new static("The repository `{$user}/{$repository}` could not be found"));
    }

    /**
     * Render the exception for a HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json([
            'status' => 'fail',
            'message' => $this->getMessage()
        ], Response::HTTP_BAD_REQUEST);
    }
}
