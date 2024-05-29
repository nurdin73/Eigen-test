function sumDiagonalMatrix(matrix = [])
{
  const diagonalPertama = [];
  const diagonalKedua = [];
  const n = matrix.length;
  for (let i = 0; i < n; i++) {
    diagonalPertama.push(matrix[i][i]);
    diagonalKedua.push(matrix[i][n - 1 - i])
  }
  let totalDiagonalPertama = 0;
  let totalDiagonalKedua = 0;
  diagonalPertama.forEach(d => {
    totalDiagonalPertama += d;
  })
  diagonalKedua.forEach(d => {
    totalDiagonalKedua += d;
  })

  return totalDiagonalPertama - totalDiagonalKedua;
}

console.log(sumDiagonalMatrix([[1, 2, 0], [4, 5, 6], [7, 8, 9]]))