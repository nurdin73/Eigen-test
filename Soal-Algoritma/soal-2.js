function longest(str = '') {  
  const strArray = str.split(' ');
  const lengthStr = strArray.length;
  let longestWord = '';

  for (let i = 0; i < lengthStr; i++) {
    if(strArray[i].length > longestWord.length) {
      longestWord = strArray[i];
    }
  }

  return `${longestWord} : ${longestWord.length} karakter`;
}

console.log(longest('Saya sangat senang mengerjakan soal algoritma'))