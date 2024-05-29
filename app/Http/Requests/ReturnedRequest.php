<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="Returned",
 *     description="Member mengembalikan buku",
 *     required=true,
 *     @OA\Property(
 *         description="Total Buku yang akan dipinjam",
 *         title="Total",
 *         type="int",
 *         property="total",
 *         default="1"
 *     ),
 *     @OA\Property(
 *         description="Kode Buku yang dikembalikan",
 *         title="Kode Buku",
 *         type="string",
 *         property="kode"
 *     )
 * )
 */
class ReturnedRequest extends FormRequest
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
            'total' => 'required|integer'
        ];
    }
}
