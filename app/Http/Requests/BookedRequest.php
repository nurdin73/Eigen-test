<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="Booked",
 *     description="Member meminjam buku",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(
 *               description="Total Buku yang akan dipinjam",
 *               title="Total",
 *               type="int",
 *               property="total",
 *               default="1"
 *          ),
 *          @OA\Property(
 *               description="Kode Buku yang dipinjam",
 *               title="Kode Buku",
 *               type="string",
 *               property="kode_buku"
 *          )
 *     ),
 * )
 */
class BookedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total' => 'required|integer|max:2',
            'kode_buku' => 'required|exists:books,code'
        ];
    }
}
