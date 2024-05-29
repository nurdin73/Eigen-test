<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\RequestBody(
 *     request="Returned",
 *     description="Member mengembalikan buku",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(
 *              description="List Buku",
 *              title="List Buku",
 *              type="array",
 *              property="books",
 *              @OA\Items(
 *                  @OA\Property(
 *                      description="Total Buku yang akan dipinjam",
 *                      title="Total",
 *                      type="int",
 *                      property="total",
 *                      default="1"
 *                  ),
 *                  @OA\Property(
 *                      description="Kode Buku yang dipinjam",
 *                      title="Kode Buku",
 *                      type="string",
 *                      property="kode_buku"
 *                  )
 *              )
 *          )
 *     ),
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
            'books' => 'required|array',
            'books.*.total' => 'required|integer',
            'books.*.kode_buku' => 'required|exists:books,code'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => "Request Body tidak sesuai",
            'errors' => $validator->errors()
        ], 422));
    }
}
