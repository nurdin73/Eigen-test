<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookedRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * @OA\Get(
     *     path="/members",
     *     tags={"members"},
     *     summary="Member Check",
     *     description="Get All existing members",
     *     operationId="checkMembers",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Member")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function index()
    {
        // 
    }

    /**
     * Member meminjam buku
     *
     * @OA\Post(
     *     path="/members/booked",
     *     tags={"members"},
     *     operationId="memberBooked",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/Booked")
     * )
     */
    public function booked(BookedRequest $request)
    {
        $data = $request->validated();
        return $data;
    }

    /**
     * Member meminjam buku
     *
     * @OA\Post(
     *     path="/members/return",
     *     tags={"members"},
     *     operationId="memberReturned",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/Returned")
     * )
     */
    public function returned(Request $request)
    {
        // 
    }
}
