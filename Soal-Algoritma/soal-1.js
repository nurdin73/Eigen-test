function reverseAlpabet(str = '') {  
  const lengthStr = str.length;
  const strArray = str.split('');
  const newStrArray = [];
  const newDigitArray = [];
  const digitList = "0123456789";
  for (let i = 0; i <= lengthStr; i++) {
    if(!digitList.includes(strArray[lengthStr - i])) {
      newStrArray.push(strArray[lengthStr - i]);
      continue;
    }
    newDigitArray.push(strArray[lengthStr - i]);
  }
  
  return newStrArray.join('') + newDigitArray.join('');
}

console.log(reverseAlpabet('NROCPOP321'));