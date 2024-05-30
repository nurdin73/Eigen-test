<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookedRequest;
use App\Http\Requests\ReturnedRequest;
use App\Http\Resources\MemberResource;
use App\Models\Book;
use App\Models\Member;
use App\Models\MemberBooked;
use App\Models\MemberPenalty;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $results = Member::withSum(['bookeds' => function ($q) {
            return $q->whereNull('return_date');
        }], 'book_total')->get();
        return MemberResource::collection($results);
    }

    /**
     * Member meminjam buku
     *
     * @OA\Post(
     *     path="/members/{id}/booking",
     *     tags={"members"},
     *     operationId="memberBooked",
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Member tidak ditemukan"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Request Error",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Request Body tidak sesuai"
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  @OA\Property(
     *                      property="total",
     *                      default="Value total harus integer"
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Member sedang dapat penalti hingga 2024-05-01!"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sukses",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Buku Berhasil dipinjam"
     *              )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Member",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/Booked")
     * )
     */
    public function booked(BookedRequest $request, $memberId)
    {
        $data = $request->validated();
        $findMember = Member::with('penalty')->where('id', $memberId)->first();
        if (!$findMember) return response(['message' => "Member tidak ditemukan"], 404);
        if ($findMember->penalty && $findMember->penalty->until >= now()->format('Y-m-d')) return response(['message' => "Member sedang dapat penalti hingga {$findMember->penalty->until}!"], 403);
        DB::beginTransaction();
        try {
            $totalBuku = 0;
            foreach ($data['books'] as $item) {
                $totalBuku += $item['total'];
                $findBook = Book::where('code', $item['kode_buku'])->first();
                MemberBooked::create([
                    'member_id' => $memberId,
                    'book_id' => $findBook->id,
                    'booked_date' => now()->format('Y-m-d'),
                    'book_total' => $item['total']
                ]);
                if ($findBook->stock <= 0) {
                    throw new Exception("Stok buku tidak cukup");
                }
                $findBook->stock -= $item['total'];
                $findBook->save();
            }
            if ($totalBuku > 2) throw new Exception("Total Buku yang dipinjam tidak boleh lebih dari 2");
            DB::commit();
            return response(['message' => "Buku berhasil dipinjam"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Member meminjam buku
     *
     * @OA\Post(
     *     path="/members/{id}/return",
     *     tags={"members"},
     *     operationId="memberReturned",
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Member tidak ditemukan"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Member Dr. Clotilde Rohan tidak meminjam buku ducimus illo quia commodi!"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Request Error",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Request Body tidak sesuai"
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  @OA\Property(
     *                      property="total",
     *                      default="Value total harus integer"
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sukses",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  default="Buku Berhasil dikembalikan"
     *              )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Member",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/Returned")
     * )
     */
    public function returned(ReturnedRequest $request, $memberId)
    {
        $data = $request->validated();
        $findMember = Member::find($memberId);
        if (!$findMember) return response(['message' => "Member tidak ditemukan"], 404);
        DB::beginTransaction();
        try {
            foreach ($data['books'] as $item) {
                $findBook = Book::where('code', $item['kode_buku'])->first();
                $findBooked = MemberBooked::where('book_id', $findBook->id)->where('member_id', $findMember->id)->whereNull('return_date')->first();
                if (!$findBooked) throw new Exception("Member {$findMember->name} tidak meminjam buku {$findBook->title}!", 403);
                if (Carbon::now()->diffInDays($findBooked->booked_date) > 7) {
                    MemberPenalty::create([
                        'member_id' => $findMember->id,
                        'booked_id' => $findBooked->id,
                        'until' => now()->addDays(3)->format('Y-m-d')
                    ]);
                }
                if ($item['total'] > $findBooked->book_total) {
                    throw new Exception("Total Buku yang dikembalikan melebihi total buku yang dipinjam", 400);
                }
                $findBooked->booked_date = now()->format('Y-m-d');
                $findBooked->save();
                $findBook->stock += $item['total'];
                $findBook->save();
            }
            DB::commit();
            return response(['message' => "Buku berhasil dikembalikan"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage()], $th->getCode() == 0 ? 400 : $th->getCode());
        }
    }
}
