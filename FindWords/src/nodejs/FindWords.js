'use strict';

const fs = require('fs');

function solution(longString, wordFile) {
    fs.readFile(wordFile, (err, data) => {
        if (err) {throw err;}
        let wordIndex = new Map();
        data.toString().split("\r\n").forEach((value) => {
            wordIndex.set(value);
        });
        let prefixIndex = new Map();
        wordIndex.forEach((value, key) => {
            if (key.length > 1) {
                let prefix = key[0] + key[1];
                if (prefixIndex.has(prefix)) {
                    let newValue = prefixIndex.get(prefix);
                    newValue.push(key);
                    prefixIndex.set(prefix, newValue);
                }
                else {
                    prefixIndex.set(prefix, [key]);
                }
            }
        });
        console.log(parseString(longString, wordIndex, prefixIndex));
    });
}

function parseString(longString, wordIndex, prefixIndex) {
    let strL = longString.length;
    let lastPos = strL-1;
    let parsedString = '';
    let x = 0;
    while (x < lastPos) {
        let prefix = [x,x+1];
        let myCache = new Map();
        let wordFound = findViaPrefix(prefix, longString, wordIndex, prefixIndex,myCache);
        if (wordFound !== null) {
            parsedString += ' ' + wordFound;
            x += wordFound.length;
        }
        else {
            parsedString += longString[x];
            x++;
            if (x === lastPos) {
                if (wordIndex.has(longString[x])) {
                    parsedString += ' ' + longString[x];
                }
                else {
                    parsedString += longString[x];
                }
            }
        }
    }
    return parsedString;
}

function findViaPrefix(prefix, longString, wordIndex, prefixIndex, myCache) {
    let prefixValue = longString[prefix[0]] + longString[prefix[1]];
    let match = null;
    if (prefixIndex.has(prefixValue)) {
        if (!myCache.has(prefixValue)) {
            let sorted = prefixIndex.get(prefixValue);
            sorted.sort((val1, val2) => {
                if (val1.length === val2.length) {return 0}
                else if (val1.length > val2.length) {return -1}
                else {return 1}
            });
            myCache.set(prefixValue, sorted);
        }
        let candidates = myCache.get(prefixValue);
        let total = candidates.length;
        for (let x=0; x<total; x++) {
            if (candidates[x] === longString.slice(prefix[0], candidates[x].length + prefix[0])) {
                match = candidates[x];
                break;
            }
        }
        if (match === null
          && wordIndex.has(longString[prefix[0]])) {
            match = longString[prefix[0]];
        }

    }
    return match;
}


solution('thequickbrownfoxjumpsoverthelazydog', 'words_alpha.txt');
solution('Iamking', 'words_alpha.txt');
solution('Iliketoeatalotofpie', 'words_alpha.txt');
solution('myfriendgavemeapieceofadvice', 'words_alpha.txt');
