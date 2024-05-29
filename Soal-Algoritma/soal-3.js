function searchTotalQueryFromInput(input = [], query = [])
{
  const lengthQuery = query.length;
  const totalInput = input.length;
  const results = [];
  for (let i = 0; i < lengthQuery; i++) {
    let total = 0;
    for (let x = 0; x < totalInput; x++) {
      if(query[i] === input[x]) {
        total += 1;
      } 
    }
    results.push(total);
  }
  return results;
}

console.log(searchTotalQueryFromInput(['xc', 'dz', 'bbb', 'dz'], ['bbb', 'ac', 'dz']))